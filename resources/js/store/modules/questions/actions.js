import questions from "../../../api/questions";

export default {
    
    saveExamQuestions({ commit }, params) {
        return new Promise((resolve, reject) => {
            questions
                .saveExamQuestions(params)
                .then(response => {
                    
                    commit("saveExamQuestions", response.data.question);
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    getExamQuestions({commit},params) {
        return new Promise((resolve, reject) => {
            questions
                .getExamQuestions(params)
                .then(response => {
                    commit("getExamQuestions", response.data.questions.questions);
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },

    updateQuestion({ commit }, params) {
        return new Promise((resolve, reject) => {
            questions
                .updateQuestion(params)
                .then(response => {
                    commit("updateQuestion", response.data.question);
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },



    deleteQuestion({ commit }, params) {
        return new Promise((resolve, reject) => {
            questions
                .deleteQuestion(params)
                .then(response => {
                    commit("deleteQuestion", response.data);
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    
    updateQuestionOrder({ commit }, params) {
        return new Promise((resolve, reject) => {
            questions
                .updateQuestionOrder(params)
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
};
