<script setup>
import { nextTick } from 'vue'
import { ref } from 'vue'
import { useStore } from '../stores/allInfo.js'
const authstore = useStore() // ✅ Safe & recommended
const getmail = ref('')
const shomessage = ref(false)
const getmail1 = ref('')
const shomessage1 = ref(false)

import { onBeforeMount, watch, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
const route = useRoute()
const router2 = useRouter()

onMounted(() => {
  if (route.query.frsh === 'true') {
    getmail.value = 'Check your mail to activate your account ' + authstore.taketmail

    shomessage.value = true

    router2.replace({ path: '/' })
  }
})
watch(
  () => authstore.activationErr,
  (newErr) => {
    console.log('activationErr changed:', newErr)
    if (newErr && newErr.length > 0) {
      getmail.value = newErr[0] // show error
      shomessage.value = false // hide green message
      shomessage1.value = false //if "updated" and "alreadydon" hide when 'error' show
    }
  },
  { immediate: true },
)
//here watchEffetc for emailVerify link on email
watch(
  () => route.query.fresh,
  (updated) => {
    if (updated === 'updated') {
      getmail1.value = 'update successfully plz u do login'
      shomessage1.value = true
      router2.replace({ path: '/login' })
    } else {
      if (updated === 'alreadydone') {
        getmail1.value = 'update alreadydone plz u do login'
        shomessage1.value = true
        router2.replace({ path: '/login' })
      }
    }
  },
  { immediate: true }, // optional: run immediately if `frsh` is already set
)

const email = ref('')
const password = ref('')

//taking composable-proccess(loginprocess.js)
import { loginProcess } from '@/composableProcess/loginprocess.js'
const { login } = loginProcess(email, password, router2)

//call composable login() method of form-handler
function loginhandler() {
  login()
}
</script>
<template>
  <div class="container d-flex justify-content-center mt-5">
    <form @submit.prevent="loginhandler">
      <div class="row d-flex flex-column">
        <!-- ✅ Message block - green for success, red for error -->
        <div class="col-3 mb-3 w-100" v-if="getmail">
          <h5 :class="['text-center p-2 text-white', shomessage ? 'bg-success' : 'bg-danger']">
            {{ getmail }}
          </h5>
        </div>

        <div class="col-3 mb-3 w-100" v-if="shomessage1">
          <h5 :class="['text-center p-2 text-white bg-success']">
            {{ getmail1 }}
          </h5>
        </div>

        <div class="col-3 mb-3 w-100">
          <div class="input-group">
            <label for="email" class="input-group-text input-group-text lwidth">email</label>
            <span class="input-group-text">✉</span>
            <input
              v-model="email"
              id="email"
              type="email"
              class="form-control"
              pattern="[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$"
              required
            />
          </div>
        </div>

        <div class="col-3 mb-3 w-100">
          <div class="input-group">
            <label for="password" class="input-group-text input-group-text lwidth">password</label>
            <span class="input-group-text">🔑</span>
            <input
              v-model="password"
              id="password"
              type="password"
              class="form-control"
              pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
              title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
              required
            />
          </div>
        </div>
      </div>
      <div class="row d-flex flex-column">
        <div class="col-3 mb-3 w-100">
          <div class="col-3 w-100 d-flex justify-content-center bg-primary mt-2 pt-0 pb-1">
            <button type="submit" class="btn btn-dark mt-2">Login Now</button>
          </div>

          <div class="col-3 w-100 d-flex justify-content-center bg-info-subtle mt-2 pt-0 pb-1">
            <button type="button" class="btn btn-dark mt-2">
              Not Have a Account?
              <RouterLink to="/signup" class="text-warning">Signup Here</RouterLink>
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>
<style scoped>
.input-group {
  height: 40px;
}
.lwidth {
  width: 95px;
}
</style>
