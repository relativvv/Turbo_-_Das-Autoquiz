import { Component, OnInit } from '@angular/core';
import {UserService} from "../../services/user.service";
import {QuizService} from "../../services/quiz.service";
import {User} from "../../models/user.model";
import {Router} from "@angular/router";
import {ToastrService} from "ngx-toastr";
import {Quiz} from "../../models/quiz.model";
import {Title} from "@angular/platform-browser";

@Component({
  selector: 'app-quiz',
  templateUrl: './quiz.component.html',
  styleUrls: ['./quiz.component.less']
})
export class QuizComponent implements OnInit {

  quiz: Quiz;
  private player: User;

  constructor(
    private readonly userService: UserService,
    private readonly quizService: QuizService,
    private readonly router: Router,
    private readonly toastService: ToastrService,
    private readonly titleService: Title
  ) {
    this.titleService.setTitle('Turbo - Das Autoquiz | Quiz');
  }

  ngOnInit(): void {
    // if(!this.userService.isLoggedIn()) {
    //   this.router.navigate(['/']);
    //   this.toastService.error('Du bist nicht eingeloggt!');
    // }

    // this.userService.currentUser
    //   .subscribe((user: User) => {
    //     this.player = user;
         this.quiz = {
          question: null,
          gameState: 'waiting',
          player: this.player
        }

        this.quizService.startQuiz();
    // });
  }
}
