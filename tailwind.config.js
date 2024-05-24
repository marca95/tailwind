/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      // On ajoute comme une variable d'environnement
      backgroundColor: {
        monBleu: "bg-indigo-900",
      }
    },
  },
  plugins: [],
}

