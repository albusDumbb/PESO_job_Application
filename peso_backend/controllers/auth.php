<?php
class AuthController {
    public function register() {
        global $conn;

        header('Content-Type: application/json');
        $response = array();

        $data = json_decode(file_get_contents("php://input"), true);

        $first_name = $data['first_name'] ?? '';
        $last_name = $data['last_name'] ?? '';
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';
        $confirm_password = $data['confirm_password'] ?? '';

        if (empty($first_name)) {
            return $this->respondWithError('First Name is required.');
        }
        if (empty($last_name)) {
            return $this->respondWithError('Last Name is required.');
        }
        if (empty($username)) {
            return $this->respondWithError('Username is required.');
        } elseif (strlen($username) < 8) {
            return $this->respondWithError('Username must be at least 8 characters long.');
        }
        if (empty($password)) {
            return $this->respondWithError('Password is required.');
        } elseif (strlen($password) < 6) {
            return $this->respondWithError('Password must be at least 6 characters long.');
        }
        if (empty($confirm_password)) {
            return $this->respondWithError('Confirm Password is required.');
        } elseif ($password !== $confirm_password) {
            return $this->respondWithError('Passwords do not match.');
        }

        $stmt = $conn->prepare("SELECT * FROM applicant_account WHERE username = ?");
        if (!$stmt) {
            return $this->respondWithError('Database error: ' . $conn->error);
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $stmt->close();
            return $this->respondWithError('Username already exists.');
        }
        $stmt->close();

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO applicant_account (first_name, last_name, username, password) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            return $this->respondWithError('Database error: ' . $conn->error);
        }
        $stmt->bind_param("ssss", $first_name, $last_name, $username, $hashed_password);

        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Account created successfully.';
            echo json_encode($response);
        } else {
            return $this->respondWithError('Error creating account: ' . $conn->error);
        }

        $stmt->close();
    }

    public function login() {
        global $conn;

        header('Content-Type: application/json');
        $response = array();

        $data = json_decode(file_get_contents("php://input"), true);

        $username = trim($data['username'] ?? '');
        $password = $data['password'] ?? '';

        if (empty($username)) {
            return $this->respondWithError('Username is required.');
        } elseif (strlen($username) < 8) {
            return $this->respondWithError('Username must be at least 8 characters long.');
        }

        if (empty($password)) {
            return $this->respondWithError('Password is required.');
        } elseif (strlen($password) < 6) {
            return $this->respondWithError('Password must be at least 6 characters long.');
        }

        $stmt = $conn->prepare("SELECT * FROM applicant_account WHERE username = ?");
        if (!$stmt) {
            return $this->respondWithError('Database query error: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                unset($user['password']);
                $response['status'] = 'success';
                $response['message'] = 'Login successful.';
                $response['user'] = $user;
                echo json_encode($response);
                return;
            } else {
                return $this->respondWithError('Invalid username or password.');
            }
        }

        $stmt->close();

        $stmt = $conn->prepare("SELECT * FROM admin_account WHERE username = ?");
        if (!$stmt) {
            return $this->respondWithError('Database query error: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                unset($user['password']);
                $response['status'] = 'success';
                $response['message'] = 'Login successful.';
                $response['user'] = $user;
                echo json_encode($response);
                return;
            } else {
                return $this->respondWithError('Invalid username or password.');
            }
        }

        $stmt->close();
        return $this->respondWithError('User not found.');
    }

    private function respondWithError($message) {
        $response = array(
            'status' => 'error',
            'message' => $message
        );
        echo json_encode($response);
        return;
    }
}
?>
