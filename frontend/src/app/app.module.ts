import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { HomeComponent } from './components/home/home.component';
import {SharedModule} from "./shared/shared.module";
import { ModeSelectComponent } from './components/home/mode-select/mode-select.component';
import { StaticsTableComponent } from './components/home/statics-table/statics-table.component';
import {MatTableModule} from "@angular/material/table";
import {NgParticlesModule} from "ng-particles";
import {NgsRevealModule} from "ngx-scrollreveal";
import { RegisterComponent } from './components/register/register.component';
import { LoginComponent } from './components/login/login.component';
import {MatCardModule} from "@angular/material/card";
import {MatFormFieldModule} from "@angular/material/form-field";
import {MatIconModule} from "@angular/material/icon";
import {MatInputModule} from "@angular/material/input";
import {MatButtonModule} from "@angular/material/button";
import { SpecifyModeComponent } from './components/specify-mode/specify-mode.component';
import { NotFoundComponent } from './components/not-found/not-found.component';
import { ModeCardComponent } from './components/specify-mode/mode-card/mode-card.component';
import { UserDetailsComponent } from './components/user-details/user-details.component';
import {ReactiveFormsModule} from "@angular/forms";
import { ChangePasswordModalComponent } from './components/user-details/change-password-modal/change-password-modal.component';
import {MatDialogModule} from "@angular/material/dialog";

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    ModeSelectComponent,
    StaticsTableComponent,
    SpecifyModeComponent,
    NotFoundComponent,
    StaticsTableComponent,
    RegisterComponent,
    LoginComponent,
    ModeCardComponent,
    UserDetailsComponent,
    ChangePasswordModalComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    SharedModule,
    MatTableModule,
    NgParticlesModule,
    NgsRevealModule,
    MatCardModule,
    MatFormFieldModule,
    MatIconModule,
    MatInputModule,
    MatButtonModule,
    ReactiveFormsModule,
    MatDialogModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
