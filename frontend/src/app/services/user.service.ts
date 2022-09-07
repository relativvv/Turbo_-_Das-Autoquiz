import { Injectable } from '@angular/core';
import {User} from "../models/user.model";
import {HttpClient} from "@angular/common/http";
import {BehaviorSubject, map, Observable, tap} from "rxjs";
import {environment} from "../../environments/environment";
import {Router} from "@angular/router";
import {ToastrService} from "ngx-toastr";

@Injectable({
  providedIn: 'root'
})
export class UserService {

  currentUserObject: BehaviorSubject<User>;
  public currentUser: Observable<User>;


  constructor(
    private readonly httpClient: HttpClient,
    private readonly router: Router,
    private readonly toastService: ToastrService
  ) {
    this.currentUserObject = new BehaviorSubject<User>(JSON.parse(localStorage.getItem('currentUser')));
    this.currentUser = this.currentUserObject.asObservable();
  }

  public isLoggedIn(): boolean {
    return !!this.currentUserValue;
  }

  public registerUser(username: string, email: string, password: string): Observable<User> {
    const user = {
      username: username,
      email: email,
      password: password
    }

    return this.httpClient.post<User>(environment.backend + "/api/user/create", user)
      .pipe(
        map(user => {
          localStorage.setItem('currentUser', JSON.stringify(user));
          this.currentUserObject.next(user);
          return user;
        }));
  }

  public loginUser(identity: string, password: string): Observable<User> {
    const user = {
      identity: identity,
      password: password
    }

    return this.httpClient.post<User>(environment.backend + "/api/user/authenticate", user)
      .pipe(
        map(user => {
          localStorage.setItem('currentUser', JSON.stringify(user));
          this.currentUserObject.next(user);
          return user;
        }));
  }

  public get currentUserValue(): User {
    return this.currentUserObject.value;
  }

  public logout(): Observable<void> {
    return this.httpClient.delete<void>(environment.backend + '/api/user/unauthenticate')
      .pipe(
        tap(() => {
          localStorage.removeItem('currentUser');
          this.currentUserObject.next(null);
          this.router.navigate(['/']);
          this.toastService.success('Erfolgreich ausgeloggt!');
          window.location.href = '/';
        })
      )
  }
}
