import { API } from "./index";

export default {
    saveExamQuestions: params =>
        API.post("admin/exams/save-exam-questions/", params),
    getExamQuestions: params =>  API.get("admin/exams/get-exam-questions/"+params.exam_id),  
};
