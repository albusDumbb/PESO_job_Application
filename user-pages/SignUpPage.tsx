import { Link } from "react-router-dom";
import Logo from "../assets/images/google-logo.png";

function SignUp() {
  return (
    <>
      <main className="SignUpPage">
        <header>
          <h1>Sign Up Now</h1>
          <p>Enter your credentials</p>
        </header>
        <form action="" className="signup-form">
          <section className="fullname-form">
            <div className="group-form">
              <label htmlFor="#firstname-input">Firsname</label>
              <input
                type="text"
                id="firstname-input"
                placeholder="Juan"
                required
              />
            </div>
            <div className="group-form">
              <label htmlFor="#lastname-input">Lastname</label>
              <input
                type="text"
                id="lastname-input"
                placeholder="Dela Cruz"
                required
              />
            </div>
          </section>

          <section className="user-pass-form">
            <label htmlFor="username">Username</label>
            <input
              type="email"
              id="username"
              placeholder="example@gmail.com"
              required
            />

            <label htmlFor="password">Password</label>
            <input
              type="number"
              id="password"
              placeholder="password123"
              required
            />

            <label htmlFor="confirm-password">Confirm Password</label>
            <input
              type="number"
              id="confirm-password"
              placeholder="password123"
              required
            />
          </section>
          <section className="terms-conditions">
            <input type="checkbox" id="terms-condition" required />
            <label htmlFor="#terms-condition">
              I agree to the <a href="">Terms and Condition</a>
            </label>
          </section>

          <input
            className="create-acc-btn"
            type="submit"
            value="Create Account"
            required
          />
        </form>
        <div className="lines2">
          <div className="line"></div>
          <p>or</p>
          <div className="line"></div>
        </div>

        <Link className="login-with-google2" to="/">
          <img src={Logo} alt="google-logo" className="google-logo" />
          Log in with Google
        </Link>
      </main>
    </>
  );
}

export default SignUp;
