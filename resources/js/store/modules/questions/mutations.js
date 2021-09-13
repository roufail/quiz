export default {
    saveExamQuestions(state, questions) {

    },
    getExamQuestions(state,questions){
        state.questions = questions;
    },
    delete_question(state,index){
        state.questions.splice(index,1);
    },
    addQuestion(state, question) {
        let mindex = state.mainQuestions
            .map(question => question.id)
            .indexOf(question.main_question_id);
        state.mainQuestions[mindex].questions.push(question);
    },
    deleteQuestion(state, ids) {
        let mindex = state.mainQuestions
            .map(question => question.id)
            .indexOf(ids.main_question_id);
        let index = state.mainQuestions[mindex].questions
            .map(question => question.id)
            .indexOf(ids.question_id);
        state.mainQuestions[mindex].questions.splice(index, 1);
    },
    updateQuestion(state, question) {
        let mindex = state.mainQuestions
            .map(question => question.id)
            .indexOf(question.main_question_id);
        let index = state.mainQuestions[mindex].questions
            .map(question => question.id)
            .indexOf(question.id);
        state.mainQuestions[mindex].questions[index] = question;
    },
};
