<template>
  <div class="col-md-12">

    <div class="title">
      Questions
      <div @click="addExtraQuestion" class="float-right pointer-cursor">
        <i class="fas fa-plus"></i>
      </div>
    </div>

    <div class="error text-danger" v-if="form_errors">
      All fields is required
    </div>

    <div class="card Question" v-if="questions.length > 0">
      <div v-for="(question,index) in questions" :key="index" class="questions-contanier">

      <div class="col-md-2 float-right">
          <i @click="delete_question(index)" class="fa fa-trash"></i>
      </div>
        
        <div class="question p-3">
          Question :
          <input type="text" v-model="question.question" /> ?
        </div>

        <ul class="list-group list-group-horizontal">
          <li class="list-group-item">
              1-
              <input v-model="question.answers[0].answer" type="text" />
          <label>
                <input :value="question.answers[0].answer" v-model="question.true_answer"   :name="'right['+index+']'" type="radio" />
                Right Answer
            </label>
          </li>

          <li class="list-group-item">
              2-
              <input v-model="question.answers[1].answer" type="text"  />
            <label>
                <input :value="question.answers[1].answer" v-model="question.true_answer"   :name="'right['+index+']'" type="radio" />
              Right Answer
            </label>
          </li>

          <li class="list-group-item">
              3-
              <input type="text"  v-model="question.answers[2].answer"  />
              <label>
                <input :value="question.answers[2].answer" v-model="question.true_answer"   :name="'right['+index+']'" type="radio" />
              Right Answer
            </label>
          </li>

          <li class="list-group-item">
              4-
              <input type="text"  v-model="question.answers[3].answer"  />

              <label>
                <input :value="question.answers[3].answer" v-model="question.true_answer"   :name="'right['+index+']'" type="radio" />
              Right Answer
            </label>
          </li>

        </ul>
      </div>

      <button class="btn btn-primary float-right">
        <div @click="saveQuestions"><i class="fas fa-save"></i></div>
      </button>
    </div>
    <div v-else>
        There is no question yet <a @click="addExtraQuestion"><strong>Add some</strong></a>
    </div>
  </div>
</template>

<script>

import { mapGetters } from 'vuex'

export default {
props: ["exam_id"],
data(){
  return {
    form_errors:false,
  }
},
methods: {
  addExtraQuestion(){
    this.questions.push({
      question:"",
      true_answer:"",
      answers: [
        {
          answer: "",
        },
        {
          answer: "",
        },
        {
          answer: "",
        },
        {
          answer: "",
        },
      ]
    });
  },
    saveQuestions(){
      this.form_errors = false;
      this.$store
        .dispatch("questions/saveExamQuestions", {questions : this.questions,exam_id: this.exam_id})
        .then((response) => {

        }).catch((error) => {
          if (error.response) {
           this.form_errors = true;
          }
        });
    },
    delete_question(index){
      if(confirm("Are you sure!")){
       this.$store.commit("questions/delete_question", index);
      }
    },
    getExamQuestions(){
      this.$store
          .dispatch("questions/getExamQuestions", {exam_id: this.exam_id})
          .then((response) => {
          }).catch({
          });
    },
},

  mounted() {
    this.getExamQuestions();
  },
  computed: {
    ...mapGetters({
      questions: "questions/Questions",
    }),
  }

}
</script>

<style lang="scss" scoped>
  .pointer-cursor{
    cursor: pointer;
  }

</style>

