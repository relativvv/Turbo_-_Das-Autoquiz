import {User} from "./user.model";

export type GameState = 'waiting' | 'question' | 'locked' | 'result' | 'end';
export type Category = 'Marken' | 'Wer, wann und wo?' | 'Motor' | 'Technik' | 'StVO';
export type Difficulty = 'leicht' | 'mittel' | 'schwer';

export interface Quiz {
  question: Question | null;
  gameState: GameState;
  player: User;
}

export interface Question {
  id: number;
  question: string;
  answers: string[];
  correctAnswer: string | null;
  category: Category | null;
  difficulty: Difficulty | null;
}
