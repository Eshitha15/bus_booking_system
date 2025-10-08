import { useState } from "react";

function App() {
  const [name, setName] = useState("");

  return (
    <div>
      <h2>Dynamic Greetings</h2>
      <input
        type="text"
        placeholder="Enter your name"
        onChange={(e) => setName(e.target.value)}
      />
      <h3>Hello, {name ? name : "Guest"}!</h3>
    </div>
  );
}

export default App;
