import { useState } from "react";
 function App() {   
    const [name, setName] = useState("");  
    return (     
    Dynamic Greeting
     setName(e.target.value)} />
    Hello, {name ? name : "Guest"}!
    ); } export default App;