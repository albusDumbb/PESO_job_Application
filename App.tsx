import { BrowserRouter, Routes, Route } from "react-router-dom";
// import css file
import "./index.css";
import "./App.css";
import "./MediaStyles/media.css";

// import components
import LogIn from "./user-pages/LogInPage.tsx";
import SignUp from "./user-pages/SignUpPage.tsx";

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<LogIn />} />
        <Route path="SignUpPage" element={<SignUp />} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;
