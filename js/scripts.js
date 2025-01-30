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

async function estaLogado() {
    return JSON.parse((await (fetch("./php/checkLogin.php")).then(resp => resp.text())));
}

async function bloquearNaoLogado(callback) {
    if (await estaLogado()) {
        callback();
    } else {
        Swal.fire({
            icon: "error",
            title: "Sessão necessária",
            text: "Inicie uma sessão para acessar esta área"
        });
    }
}

async function checkNivel() {
    return (await (fetch("./php/checkNivel.php")).then(resp => resp.text()));
}

async function crudAluno(action, data) {
    const post = new FormData();
    if (action) post.append("action", action);
    for (const key in data) {
        if (data.hasOwnProperty(key)) {
            post.append(key, data[key]);
        }
    }

    fetch(`./php/crud_aluno.php`, {
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
                    title: "Edição bem-sucedida",
                    text: resp.mensagem
                });
            }
            if (resp.status === "erro") {
                Swal.fire({
                    icon: "error",
                    title: "Erro na operação",
                    text: resp.mensagem
                });
            }
        }
    });
}

async function crudAula(action, data) {
    const post = new FormData();
    if (action) post.append("action", action);
    for (const key in data) {
        if (data.hasOwnProperty(key)) {
            post.append(key, data[key]);
        }
    }

    fetch(`./php/crud_aula.php`, {
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
                    title: "Edição bem-sucedida",
                    text: resp.mensagem
                });
            }
            if (resp.status === "erro") {
                Swal.fire({
                    icon: "error",
                    title: "Erro na operação",
                    text: resp.mensagem
                });
            }
        }
    });
}

async function crudInstrutor(action, data) {
    const post = new FormData();
    if (action) post.append("action", action);
    for (const key in data) {
        if (data.hasOwnProperty(key)) {
            post.append(key, data[key]);
        }
    }

    fetch(`./php/crud_instrutor.php`, {
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
                    title: "Edição bem-sucedida",
                    text: resp.mensagem
                });
            }
            if (resp.status === "erro") {
                Swal.fire({
                    icon: "error",
                    title: "Erro na operação",
                    text: resp.mensagem
                });
            }
        }
    });
}

function editarAluno(id) {
    Swal.fire({
        title: 'Editar Aluno',
        html: `
            <input id="swal-input1" class="swal2-input" placeholder="Nome">
            <input id="swal-input2" class="swal2-input" placeholder="Endereço">
            <input id="swal-input3" class="swal2-input" placeholder="Telefone">
        `,
        focusConfirm: false,
        preConfirm: () => {
            const values = {
                nome: document.getElementById('swal-input1').value,
                endereco: document.getElementById('swal-input2').value,
                telefone: document.getElementById('swal-input3').value
            }
            for (const [ key, value ] of Object.entries(values)) {
                if (!value) delete values[key]
            }
            return values;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            crudAluno("update", { id, ...result.value});
        }
    });
}

function editarInstrutor(id) {
    Swal.fire({
        title: 'Editar Instrutor',
        html: `
            <input id="swal-input1" class="swal2-input" placeholder="Nome">
            <select id="swal-input2" class="swal2-input">
                <option value="" disabled selected>Especialidade</option>
                <option value="Pilates">Pilates</option>
                <option value="Crossfit">Crossfit</option>
                <option value="Musculação">Musculação</option>
                <option value="Yoga">Yoga</option>
                <option value="Aeróbica">Aeróbica</option>
                <option value="Ginástica">Ginástica</option>
                <option value="Alongamento">Alongamento</option>
                <option value="Luta">Luta</option>
            </select>
        `,
        focusConfirm: false,
        preConfirm: () => {
            const values = {
                nome: document.getElementById('swal-input1').value,
                especialidade: document.getElementById('swal-input2').value
            }
            for (const [ key, value ] of Object.entries(values)) {
                if (!value) delete values[key]
            }
            return values;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            crudInstrutor("update", { id, ...result.value });
        }
    });
}

function editarAula(id) {
    Swal.fire({
        title: 'Editar Aula',
        html: `
            <input id="swal-input1" class="swal2-input" placeholder="Dia da Semana">
            <select id="swal-input2" class="swal2-input">
                <option value="" disabled selected>Modalidade</option>
                <option value="Pilates">Pilates</option>
                <option value="Crossfit">Crossfit</option>
                <option value="Musculação">Musculação</option>
                <option value="Yoga">Yoga</option>
                <option value="Aeróbica">Aeróbica</option>
                <option value="Ginástica">Ginástica</option>
                <option value="Alongamento">Alongamento</option>
                <option value="Luta">Luta</option>
            </select>
            <input id="swal-input3" class="swal2-input" placeholder="Email do Instrutor">
            <input id="swal-input4" class="swal2-input" placeholder="Email do Aluno">
        `,
        focusConfirm: false,
        preConfirm: () => {
            const values = {
                data: document.getElementById('swal-input1').value,
                tipo: document.getElementById('swal-input2').value,
                instrutor: document.getElementById('swal-input3').value,
                aluno: document.getElementById('swal-input4').value
            }
            for (const [ key, value ] of Object.entries(values)) {
                if (!value) delete values[key]
            }
            return values;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            crudAula("update", { id, ...result.value });
        }
    });
}