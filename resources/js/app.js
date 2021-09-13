
 require("./bootstrap");
 import store from "./store/store";
 
 window.Vue = require("vue").default;
 
 import Form from 'vform'
 import Multiselect from "vue-multiselect";
 import Swal from "sweetalert2";
 
 window.Form = Form;
 window.Swal = Swal;
 
 // sweetalert
 const Toast = Swal.mixin({
     toast: true,
     position: "top-end",
     showConfirmButton: false,
     timer: 3000
 });
 
 // global toaster alert
 window.Toast = Toast;
 
 Vue.component("multiselect", Multiselect);
 
 Vue.component(
     "exam-questions",
     require("./components/ExamQuestionsComponents.vue").default
 );

 
  
new Vue({
     el: "#app",
     store
 });
 