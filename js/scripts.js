function erroExterno(resp) {
    Swal.fire({
        icon: "warning",
        title: "Erro externo",
        text: "Consulte os administradores do site para saber mais.\n" + `[${resp}]`
    });
}

function tryJSON(resp) {
    if (resp.headers.get("content-type")?.includes("application/json")) {
        return resp.json();
    } else {
        return resp.text();
    }
}

async function registroAluno(nome, email, senha, cpf, endereco, telefone) {
    const post = new FormData();

    if (nome) post.append("nome", nome);
    if (email) post.append("email", email);
    if (senha) post.append("senha", senha);
    if (cpf) post.append("cpf", cpf);
    if (endereco) post.append("endereco", endereco);
    if (telefone) post.append("telefone", telefone);

    fetch("./php/registro_aluno.php", {
        method: "POST",
        body: post
    }).then(resp => tryJSON(resp)).then(resp => {
        if (typeof resp === "string") {
            erroExterno(resp);
        }
        if (typeof resp === "object") {
            if (resp.status === "sucesso") {
                Swal.fire({
                    icon: "success",
                    title: "Registro efetuado",
                    text: resp.mensagem
                }).then(() => {
                    window.location.href = "./index.php";
                });
            }
            if (resp.status === "erro") {
                Swal.fire({
                    icon: "error",
                    title: "Erro no registro",
                    text: resp.mensagem
                });
            }
        }
    });
}

async function registroInstrutor(nome, email, senha, especialidade) {
    const post = new FormData();

    if (nome) post.append("nome", nome);
    if (email) post.append("email", email);
    if (senha) post.append("senha", senha);
    if (especialidade) post.append("especialidade", especialidade);

    fetch("./php/registro_instrutor.php", {
        method: "POST",
        body: post
    }).then(resp => tryJSON(resp)).then(resp => {
        if (typeof resp === "string") {
            erroExterno(resp);
        }
        if (typeof resp === "object") {
            if (resp.status === "sucesso") {
                Swal.fire({
                    icon: "success",
                    title: "Registro efetuado",
                    text: resp.mensagem
                }).then(() => {
                    window.location.href = "./index.php";
                });
            }
            if (resp.status === "erro") {
                Swal.fire({
                    icon: "error",
                    title: "Erro no registro",
                    text: resp.mensagem
                });
            }
        }
    });
}

async function loginAluno(email, senha) {
    const post = new FormData();

    if (email) post.append("email", email);
    if (senha) post.append("senha", senha);

    fetch("./php/login_aluno.php", {
        method: "POST",
        body: post
    }).then(resp => tryJSON(resp)).then(resp => {
        if (typeof resp === "string") {
            erroExterno(resp);
        }
        if (typeof resp === "object") {
            if (resp.status === "sucesso") {
                Swal.fire({
                    icon: "success",
                    title: "Sessão iniciada",
                    text: resp.mensagem
                }).then(() => {
                    window.location.href = "./index.php";
                });
            }
            if (resp.status === "erro") {
                Swal.fire({
                    icon: "error",
                    title: "Erro na entrada",
                    text: resp.mensagem
                });
            }
        }
    });
}

async function loginInstrutor(email, senha) {
    const post = new FormData();

    if (email) post.append("email", email);
    if (senha) post.append("senha", senha);

    fetch("./php/login_instrutor.php", {
        method: "POST",
        body: post
    }).then(resp => tryJSON(resp)).then(resp => {
        if (typeof resp === "string") {
            erroExterno(resp);
        }
        if (typeof resp === "object") {
            if (resp.status === "sucesso") {
                Swal.fire({
                    icon: "success",
                    title: "Sessão iniciada",
                    text: resp.mensagem
                }).then(() => {
                    window.location.href = "./index.php";
                });
            }
            if (resp.status === "erro") {
                Swal.fire({
                    icon: "error",
                    title: "Erro na entrada",
                    text: resp.mensagem
                });
            }
        }
    });
}

async function logout() {
    fetch("./php/logout.php").then(resp => {
        if (resp.ok) {
            Swal.fire({
                icon: "success",
                title: "Sessão encerrada",
                text: "Você foi desconectado com sucesso."
            }).then(() => {
                window.location.href = "./index.php";
            });
        } else {
            return resp.text().then(text => console.log(text));
        }
    });
}