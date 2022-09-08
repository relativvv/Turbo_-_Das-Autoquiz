import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import {GameState} from "../../../models/quiz.model";

@Component({
  selector: 'app-answers',
  templateUrl: './answers.component.html',
  styleUrls: ['./answers.component.less']
})
export class AnswersComponent implements OnInit {

  @Input() gameState: GameState;
  @Input() answers: string[];
  @Input() correctAnswer: string;
  @Input() lockedAnswer: string;
  @Output() answerLocked = new EventEmitter<string>;

  constructor() { }

  ngOnInit(): void {
  }

  lockAnswer(answer: string): void {
    if(this.gameState === 'question') {
      this.lockedAnswer = answer;
      this.answerLocked.emit(answer);
    }
  }
}
