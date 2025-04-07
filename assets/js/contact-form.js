/**

  HTML Landing Pages Pack

  - Version: 1.0

  - 2021
  
  - Author: fronthemes
  
  - https://fronthemes.com

 */

 /*=================================================
 =            JAVASCRIPT - CONTACT FORM            =
 =================================================*/

"use strict"

const $contactForm = document.querySelector('#contact-form')

$contactForm.addEventListener('submit', async function (e) {

  e.preventDefault()

  const $successMessage = document.querySelector('#success-message')
  const $errorMessage = document.querySelector('#error-message')

  $successMessage.style.display = 'none'
  $errorMessage.style.display = 'none'

  await fetch($contactForm.action, {
    method: $contactForm.method,
    cache: 'no-cache',
    body: new FormData($contactForm)
  })
    .then(response => {
      if (response.status === 200) {
        $successMessage.style.display = 'block'
      } else {
        $errorMessage.style.display = 'block'
      }
    })
    .catch(err => {
      $errorMessage.style.display = 'block'
    })

  return false

})