import { ref, unref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
import { useStore } from '../stores/allInfo.js'
const bigerr2 = ref('')
const bigdata = ref('')

//make composable funtion for login.vue
function loginProcess(email, password, router2) {
  //const router = useRouter()
  const usestore = useStore()

  const login = async () => {
    const form = {
      email: unref(email),
      password: unref(password),
    }

    try {
      const res = await axios.post(
        ' http://localhost/phpAPI_verifyRegisteredEmailID/login.php',
        form,
      )
      console.log('res.data', res.data) //{errors: Array(1)}//errors: ['first-plz go to activation email link for active account then login']
      if (res.data.errors) {
        bigerr2.value = res.data.errors

        console.log('bigerr2', bigerr2) //rawValue:['first-plz go to activation email link for active account then login']
        console.log('bigerr2.value', bigerr2.value) //{0: 'first-plz go to activation email link for active account then login'}
      } else {
        if (Array.isArray(res.data.response) && res.data.response.includes('Login successful')) {
          const targetRoute = { path: '/simple' }
          if (targetRoute && targetRoute.path) {
            await router2.push(targetRoute)
          }
          bigerr2.value = ''
        }
      }
      usestore.activation(bigerr2.value)
      console.log('usestore.activationErr', usestore.activationErr)
      //Proxy(Array) {0: 'first-plz go to activation email link for active account then login'}...
      // which getting authstore.activationErr = ['first-plz go to activation email link for active account then login']
    } catch (err) {
      console.log('try error', err)
    }
  }
  return { login }
}
export { loginProcess }

/*
important point:-
[Vue Router warn]: router.resolve() was passed an invalid location. This will fail in production.
⚠️ कारण:
आपने कहीं router.resolve(something) या router.push(something) किया है लेकिन something = undefined है।

❌ गलत:
js
Copy
Edit
await router.push(targetRoute) // लेकिन `targetRoute = undefined`
✅ सही:
js
Copy
Edit
const targetRoute = { path: '/simple' };
if (targetRoute && targetRoute.path) {
  await router.push(targetRoute);
}

*/
