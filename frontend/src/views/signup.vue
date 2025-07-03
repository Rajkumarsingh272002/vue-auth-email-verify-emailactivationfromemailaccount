<script setup>
import { ref, onMounted } from 'vue'
import { signupprocess } from '@/composableProcess/signupProcess.js'
const username = ref('')
const email = ref('')
const mobile = ref('')
const password = ref('')
const cpassword = ref('')

//using pinia
import { useStore } from '../stores/allInfo.js'
const authstore = useStore()

import { useRouter } from 'vue-router'
const router = useRouter()
const { signup } = signupprocess(username, email, mobile, password, cpassword)
function signupHandler() {
  if (password.value !== cpassword.value) {
    alert('sorry password and cpassword no match')
  }
  console.log('here is checking for debuggin signup.vue, signup handler running')
  signup()
  //after submit button
}
</script>
<template>
  <div class="container d-flex justify-content-center mt-5">
    <form @submit.prevent="signupHandler">
      <!-- here we say if we found error any show here same page-->
      <div class="row d-flex flex-column">
        <div class="col-3 mb-3 w-100" v-if="authstore.dataerror.length">
          <h4 class="bg-danger text-center p-2">{{ authstore.dataerror[0] }}</h4>
        </div>
      </div>

      <!-- here form data strat here-->
      <div class="row d-flex flex-column">
        <div class="col-3 mb-3 w-100">
          <div class="input-group">
            <label for="username" class="input-group-text input-group-text">username</label>
            <span class="input-group-text">@</span>
            <input
              v-model="username"
              id="username"
              type="text"
              class="form-control winput"
              required
            />
          </div>
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
            <label for="mobile" class="input-group-text input-group-text lwidth">mobile</label>
            <span class="input-group-text">🕿</span>
            <input
              v-model="mobile"
              id="mobile"
              type="tel"
              pattern="[7-9][0-9]{9}"
              maxlength="10"
              class="form-control"
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
          <div class="input-group">
            <label for="cpassword" class="input-group-text input-group-text lwidth"
              >cpassword</label
            >
            <span class="input-group-text">🔑</span>
            <input
              v-model="cpassword"
              id="cpassword"
              type="password"
              class="form-control winput"
              pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
              title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
              required
            />
          </div>

          <div class="col-3 w-100 d-flex justify-content-center bg-primary mt-2 pt-0 pb-1">
            <button type="submit" class="btn btn-dark mt-2">create Account</button>
          </div>

          <div class="col-3 w-100 d-flex justify-content-center bg-info-subtle mt-2 pt-0 pb-1">
            <button type="button" class="btn btn-dark mt-2">
              Have a Account? <RouterLink to="/login" class="text-warning">Log in</RouterLink>
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
