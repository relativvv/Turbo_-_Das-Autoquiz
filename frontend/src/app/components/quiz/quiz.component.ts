import { Component, OnInit } from '@angular/core';
import {UserService} from "../../services/user.service";
import {QuizService} from "../../services/quiz.service";
import {User} from "../../models/user.model";
import {ActivatedRoute, Router} from "@angular/router";
import {ToastrService} from "ngx-toastr";
import {Category, Difficulty, Question, Quiz} from "../../models/quiz.model";
import {Title} from "@angular/platform-browser";

@Component({
  selector: 'app-quiz',
  templateUrl: './quiz.component.html',
  styleUrls: ['./quiz.component.less']
})
export class QuizComponent implements OnInit {

  quiz: Quiz;
  countdown = 3;
  timer = 3;
  minutes = 0;
  timerVar = null;
  lives = 3;
  lockedAnswer: string;
  timeString: string;

  private player: User;
  private difficulty: Difficulty | null;
  private category: Category | null;

  constructor(
    private readonly userService: UserService,
    private readonly quizService: QuizService,
    private readonly router: Router,
    private readonly toastService: ToastrService,
    private readonly titleService: Title,
    private readonly route: ActivatedRoute
  ) {
    this.titleService.setTitle('Turbo - Das Autoquiz | Quiz');
    this.route.params.subscribe(params => {
      this.category = params['category'];
      this.difficulty = params['difficulty'];

      if(this.category) {
        if(!(this.category === 'Motor' || this.category === 'Technik' || this.category === 'Marken' || this.category === 'StVO' || this.category === 'Wer, wann und wo?')) {
          this.router.navigate(['/']);
          this.toastService.error('Ein Fehler ist aufgetreten.');
          return;
        }
      }


      if(this.difficulty) {
        if(!(this.difficulty === 'leicht' || this.difficulty === 'mittel' || this.difficulty === 'schwer')) {
          this.router.navigate(['/']);
          this.toastService.error('Ein Fehler ist aufgetreten.');
          return;
        }
      }
    })
  }

  ngOnInit(): void {
    if(!this.userService.isLoggedIn()) {
      this.router.navigate(['/']);
      this.toastService.error('Du bist nicht eingeloggt!');
    }

    this.userService.currentUser
      .subscribe((user: User) => {
        this.player = user;
          this.quiz = {
            question: null,
            gameState: 'waiting',
            player: this.player,
         }

        this.startQuiz();
    });
  }

  private startQuiz(): void {
    this.timerVar = setInterval(() => {
      this.timer++;

      if(this.timer === 60) {
        this.timer = 0;
        this.minutes++;
      }

      const secondString = this.timer < 10 ? '0' + this.timer : this.timer.toString();
      const minuteString = this.minutes < 10 ? '0' + this.minutes : this.minutes;

      this.timeString = minuteString + ':' + secondString;
    }, 1000);

    if(this.quiz.gameState === 'waiting') {
      const cd = setInterval(() => {
        this.countdown--;

        if(this.countdown === 0) {
          setTimeout(() => {
            this.runQuiz();
          }, 900);
          clearInterval(cd);
        }
      }, 1000);
    }
  }

  private runQuiz(): void {
    if(this.category) {
      this.quizService.getQuestionByCategory(this.category)
        .subscribe((question: Question) => {
          this.quiz.question = question;
          this.quiz.gameState = 'question';
        })
      return;
    }

    if(this.difficulty) {
      this.quizService.getQuestionByDifficulty(this.difficulty)
        .subscribe((question: Question) => {
          this.quiz.question = question;
          this.quiz.gameState = 'question';
        })
      return;
    }
  }

  revealAnswer(lockedAnswer: string): void {
    this.lockedAnswer = lockedAnswer;
    this.quiz.gameState = 'locked';

    setTimeout(() => {
      this.quizService.checkAnswer(this.quiz.question.id, lockedAnswer)
        .subscribe((result: Question) => {
          this.quiz.question.correctAnswer = result.correctAnswer;
          this.quiz.gameState = 'result';
          if(this.lockedAnswer !== result.correctAnswer) {
            this.lives--;
            if(this.lives === 0) {
              clearInterval(this.timerVar);
              this.toastService.error('Du hast leider verloren!');
              this.quiz.gameState = 'end';
              setTimeout(() => {
                this.router.navigate(['/']);
              }, 2500);
              return;
            }
          }

          setTimeout(() => {
            this.quiz.gameState = 'question';
            this.lockedAnswer = null;
            this.quiz.question.question = '';
            this.quiz.question.answers = ['', '', '', ''];
            this.runQuiz();
          }, 2000);
        })
    }, 1000);
  }

}
