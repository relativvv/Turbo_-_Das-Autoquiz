import { Component, OnInit } from '@angular/core';
import {UserService} from "../../services/user.service";
import {User} from "../../models/user.model";

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.less']
})
export class ProfileComponent implements OnInit {

  user: User;

  constructor(
    private readonly userService: UserService,
  ) { }

  ngOnInit(): void {
    if(this.isLoggedIn()) {
      this.getUser();
    }
  }

  isLoggedIn(): boolean {
    return this.userService.isLoggedIn();
  }

  logout(): void {
    this.userService.logout().subscribe();
  }

  private getUser(): void {
    this.userService.currentUser.subscribe((user: User) => {
      this.user = user;
    })
  }

}
