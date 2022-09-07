import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { QuizComponent } from './quiz.component';
import { QuestionComponent } from './question/question.component';
import { LivesComponent } from './lives/lives.component';
import { AnswersComponent } from './answers/answers.component';
import { JokerComponent } from './joker/joker.component';
import {SharedModule} from "../../shared/shared.module";
import {NgxTypedJsModule} from "ngx-typed-js";



@NgModule({
  declarations: [
    QuizComponent,
    QuestionComponent,
    LivesComponent,
    AnswersComponent,
    JokerComponent
  ],
  imports: [
    CommonModule,
    SharedModule,
    NgxTypedJsModule
  ]
})
export class QuizModule { }
