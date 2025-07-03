import { unref, ref } from 'vue'
import axios from 'axios'
import { useStore } from '../stores/allInfo.js'
import { useRouter } from 'vue-router'
const data = ref('')
const error = ref('')
const takingmail = ref('')
function signupprocess(username, email, mobile, password, cpassword) {
  const usestore = useStore() // ✅ Safe & recommended
  const router = useRouter() // ✅ Mandatory
  const signup = async () => {
    const form = {
      username: unref(username),
      email: unref(email),
      mobile: unref(mobile),
      password: unref(password),
      cpassword: unref(cpassword),
    }

    try {
      console.log(
        'here is checking for debuggin using composable,data come from signup page',
        form.username,
      )

      //using api and take request
      const res = await axios.post(
        'http://localhost/phpAPI_verifyRegisteredEmailID/signupForm.php',
        form,
      )
      if (res.data) {
        console.log('res.data', res.data)
        data.value = res.data
        console.log(data.value)

        if (Array.isArray(res.data.response) && res.data.response.includes('signup successful')) {
          console.log('everything is ok')
          usestore.datamessage = 'signup successful'
          console.log('usestore.datamessage', usestore.datamessage)
          //taking mail
          takingmail.value = res.data.response.find((item) => item.includes('@'))
          usestore.takemailfun(takingmail.value)
          console.log('usestore.taketmail', usestore.taketmail)
          console.log('usestore.taketmail', usestore.taketmail)
          error.value = ''
          usestore.dataerror = [] // clear errors
          await router.push({ path: '/login', query: { frsh: true } })
        } else {
          console.log('sorry')
          error.value = res.data.errors
          usestore.dataerror = error.value
          console.log(usestore.dataerror)
          /*
          note:-
          res.data → { success: false, errors: [...] }
          res.data.errors → ["email already available in database"] (i.e. ek array)
          */
        }
      }
    } catch (err) {
      console.log('error into try', err)
    }
  }
  return { signup }
}
export { signupprocess }
