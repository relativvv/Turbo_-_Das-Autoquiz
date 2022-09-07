import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {HomeComponent} from "./components/home/home.component";
import {SpecifyModeComponent} from "./components/specify-mode/specify-mode.component";
import {NotFoundComponent} from "./components/not-found/not-found.component";
import {LoginComponent} from "./components/login/login.component";
import {RegisterComponent} from "./components/register/register.component";
import {UserDetailsComponent} from "./components/user-details/user-details.component";

const routes: Routes = [
  { path: '', component: HomeComponent },
  { path: 'mode/:selectedMode', component: SpecifyModeComponent },
  { path: 'login', component: LoginComponent },
  { path: 'register', component: RegisterComponent },
  { path: 'user/:userName', component: UserDetailsComponent },
  { path: '**', component: NotFoundComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
