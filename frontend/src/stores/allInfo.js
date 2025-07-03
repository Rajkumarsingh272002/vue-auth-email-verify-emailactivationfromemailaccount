import { ref, computed } from 'vue'
import { defineStore } from 'pinia'

export const useStore = defineStore('allinfo', () => {
  const datamessage = ref('')
  const dataerror = ref('')
  const taketmail = ref('')
  const activationErr = ref('')
  if (datamessage) {
    console.log(datamessage.value)
  } else {
    console.log(dataerror.value)
  }

  function takemailfun(mail) {
    taketmail.value = mail
  }

  function balnkmail() {
    taketmail.value = ''
  }

  function activation(activeerror) {
    activationErr.value = activeerror //
  }
  return {
    datamessage, // ✅ State expose
    dataerror, // ✅ State expose
    takemailfun,
    taketmail,
    balnkmail,
    activation,
    activationErr, //unwarp hokar jayega
  }
})
