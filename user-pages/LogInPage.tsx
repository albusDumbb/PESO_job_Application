import { Link } from "react-router-dom";
import Logo from "../assets/images/google-logo.png";
import PesoLogo from "../assets/images/p.png";

function LogIn() {
  return (
    <>
      <main className="LogInPage">
        <section className="logo-container">
          <img src={PesoLogo} alt="" />
          <h2>
            SIGN-IN YOUR <br /> ACCOUNT
          </h2>
        </section>
        <section className="login-container">
          <header>
            <h1>Welcome</h1>
            <p>Please enter your details</p>
          </header>
          <form className="login-form" action="">
            <label htmlFor="#username">Username</label>
            <input
              className="login-form-input"
              placeholder="example@gmail.com"
              name="_userame"
              type="email"
              id="username"
              required
            />

            <label htmlFor="#password">Password</label>
            <input
              className="login-form-input"
              placeholder="password123"
              name="_password"
              type="number"
              id="password"
              required
            />

            <Link to="/" className="forgot-pass">
              Forgot Password?
            </Link>

            <div className="login-btn">
              <input type="submit" value="Login" />
            </div>
          </form>
          <div className="lines">
            <div className="line"></div>
            <p>or</p>
            <div className="line"></div>
          </div>

          <Link className="login-with-google" to="/">
            <img src={Logo} alt="google-logo" className="google-logo" />
            Log in with Google
          </Link>

          <div className="signup-btn">
            <p>Don't have an account?</p>
            <Link className="signup-link" to="SignUpPage">
              Sign Up
            </Link>
          </div>
        </section>
      </main>
    </>
  );
}

export default LogIn;
