// document.addEventListener('DOMContentLoaded', function() {

//     const stepForms = document.querySelectorAll('.content'); // Get all steps
//     const nextButtons = document.querySelectorAll('.btn-next'); // Get all next buttons
//     const prevButtons = document.querySelectorAll('.btn-prev'); // Get all previous buttons
//     let currentStep = 0;

//     // Show only the first step at the beginning
//     stepForms.forEach((form, index) => {
//         form.style.display = (index === 0) ? 'block' : 'none';
//     });

//     // Validate Name and Phone Fields for Step 1
//     function validateStep1() {
//         const name = document.querySelector('input[name="name"]').value;
//         const phone = document.querySelector('input[name="phone"]').value;
//         const phonePattern = /^\d{11}$/; // Simple 10-digit phone number validation

//         if (name.trim() === '') {
//            {{ session()->flash('success',__('site.createAdmin')); }}
//             return false;
//         }

//         if (!phonePattern.test(phone)) {
//             alert('Please enter a valid phone number.');
//             return false;
//         }

//         return true;
//     }

//     // Validate Case Description for Step 2
//     function validateStep2() {
//         const titleAr = document.querySelector('input[name="title_ar"]').value;
//         const titleEn = document.querySelector('input[name="title_en"]').value;
//         const descriptionAr = document.querySelector('textarea[name="description_ar"]').value;
//         const descriptionEn = document.querySelector('textarea[name="description_en"]').value;
//         const image = document.querySelector('input[name="images[]"]').value;

//         if (titleAr.trim() === '' || titleEn.trim() === '') {
//             alert('Both Arabic and English titles are required.');
//             return false;
//         }

//         if (descriptionAr.trim() === '' || descriptionEn.trim() === '') {
//             alert('Both Arabic and English descriptions are required.');
//             return false;
//         }

//         if (image.trim() === '') {
//             alert('Image is required.');
//             return false;
//         }

//         return true;
//     }

//     // Validate Case Needs for Step 3 (either price or item)
//     function validateStep3() {
//         const price = document.querySelector('input[name="price"]').value;
//         const itemFields = document.querySelectorAll('select[name="item_id"]');

//         if (price.trim() === '' && itemFields.length === 0) {
//             alert('Please specify either a price or add an item.');
//             return false;
//         }

//         return true;
//     }

//     // Show next step and hide the current one
//     function showStep(stepIndex) {
//         stepForms.forEach((form, index) => {
//             form.style.display = (index === stepIndex) ? 'block' : 'none';
//         });
//     }

//     // Add event listeners to Next buttons
//     nextButtons.forEach((button, index) => {
//         button.addEventListener('click', function(e) {
//             e.preventDefault();

//             let isValid = false;
//             switch (index) {
//                 case 0:
//                     isValid = validateStep1(); // First step validation
//                     break;
//                 case 1:
//                     isValid = validateStep2(); // Second step validation
//                     break;
//                 case 2:
//                     isValid = validateStep3(); // Third step validation
//                     break;
//             }

//             if (isValid) {
//                 currentStep++;
//                 showStep(currentStep); // Show next step if validation passes
//             }
//         });
//     });

//     // Add event listeners to Previous buttons
//     prevButtons.forEach((button, index) => {
//         button.addEventListener('click', function(e) {
//             e.preventDefault();
//             currentStep--;
//             showStep(currentStep); // Go back to the previous step
//         });
//     });
// });
