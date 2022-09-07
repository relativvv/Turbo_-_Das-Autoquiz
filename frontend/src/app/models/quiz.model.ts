import {User} from "./user.model";

type GameState = 'waiting' | 'question' | 'locked' | 'result' | 'end';

export interface Quiz {
  question: Question | null;
  gameState: GameState;
  player: User;
}

export interface Question {
  id: number;
}
