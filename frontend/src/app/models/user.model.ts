export interface User {
  id: number,
  username: string;
  image: string | null;
  email: string;
  highestStreak: number | null;
  highestOverallStreak: number | null;
  playedGames: number | null;
}
