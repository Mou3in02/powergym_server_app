function handleLogin() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    console.log("Username:", username);
    console.log("Password:", password);

    // Ici tu peux ajouter ton appel API ou logique de connexion
    alert(`Login attempted with username: ${username} and password: ${password}`);
}
