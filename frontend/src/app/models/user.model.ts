export interface User {
  id: number,
  username: string;
  email: string;
  highestStreak: number | null;
  highestOverallStreak: number | null;
  playedGames: number | null;
}
