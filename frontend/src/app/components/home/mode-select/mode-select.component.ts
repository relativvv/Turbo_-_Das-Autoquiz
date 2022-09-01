import {Component, Input, OnInit} from '@angular/core';
import {UserService} from "../../../services/user.service";

type Mode = 'difficulty' | 'category';

@Component({
  selector: 'app-mode-select',
  templateUrl: './mode-select.component.html',
  styleUrls: ['./mode-select.component.less']
})
export class ModeSelectComponent implements OnInit {

  @Input() type: Mode;
  @Input() text: string;

  constructor(
    private readonly userService: UserService
  ) { }

  ngOnInit(): void {
  }

  isLoggedIn(): boolean {
    return this.userService.isLoggedIn();
  }

}
