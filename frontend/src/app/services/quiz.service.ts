import { Injectable } from '@angular/core';
import {Observable} from "rxjs";
import {Category, Difficulty, Question} from "../models/quiz.model";
import {HttpClient} from "@angular/common/http";
import {environment} from "../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class QuizService {

  constructor(
    private readonly http: HttpClient
  ) { }

  getQuestionByCategory(category: Category): Observable<Question> {
    return this.http.get<Question>(environment.backend + '/api/get/question/category/' + category);
  }

  getQuestionByDifficulty(difficulty: Difficulty): Observable<Question> {
    return this.http.get<Question>(environment.backend + '/api/get/question/difficulty/' + difficulty);
  }

  checkAnswer(question: number, answer: string): Observable<Question> {
    const payload = {
      id: question,
    }

    return this.http.post<Question>(environment.backend + '/api/check/question', payload);
  }

}
