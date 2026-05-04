/** @type {import('tailwindcss').Config} */
/** Theme tokens aligned with jobscape_laravel/tailwind.config.js (+ border-subtle for borders). */
module.exports = {
  content: ["./App/**/*.php"],
  theme: {
    extend: {
      colors: {
        jobscape: {
          page: "#FAF7F2",
          surface: "#FFFFFF",
          soft: "#F3EEE6",
          navBg: "#FDFBF7",
          primary: "#3D2E26",
          secondary: "#6B5A52",
          coral: "#E07A5F",
          coralDark: "#C45E48",
          terracotta: "#C86D55",
          brand: "#AD5238",
          brandDeep: "#9A4931",
          hireBar: "#BA482E",
          "border-subtle": "rgb(61 46 38 / 0.12)",
        },
      },
      fontFamily: {
        fraunces: ['"Fraunces"', "Georgia", "Times New Roman", "serif"],
        outfit: ['"Outfit"', "system-ui", "sans-serif"],
        logo: ['"Nunito"', '"Outfit"', "system-ui", "sans-serif"],
      },
      boxShadow: {
        jobscape: "0 12px 40px rgba(61, 46, 38, 0.08)",
        jobscapeSoft: "0 2px 8px rgba(61, 46, 38, 0.06)",
      },
      maxWidth: {
        jobscape: "1240px",
      },
      borderRadius: {
        capsule: "999px",
      },
    },
  },
  plugins: [],
};
