let offset = 0;
const limit = 10;

document.addEventListener('DOMContentLoaded', function () {
    loadProfessionals();
});

document.getElementById('searchForm').addEventListener('submit', function (e) {
    e.preventDefault();
    offset = 0;
    loadProfessionals(true);
});

document.getElementById('verMais').addEventListener('click', function () {
    loadProfessionals();
});

function loadProfessionals(clear = false) {
    const profissao = document.getElementById('profissao').value;
    const nome = document.getElementById('nome').value;

    fetch(`busca_profissionais.php?profissao=${encodeURIComponent(profissao)}&nome=${encodeURIComponent(nome)}&offset=${offset}&limit=${limit}`)
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                return response.text().then(text => {
                    throw new Error(`Erro na resposta: ${text}`);
                });
            }
        })
        .then(data => {
            if (clear) {
                document.getElementById('profissionais').innerHTML = '';
            }

            if (data.profissionais) {
                data.profissionais.forEach(profissional => {
                    const section = document.createElement('section');
                    section.classList.add('profissional');

                    section.innerHTML = `
                        <img src="../paginas/imagens/foto4.jpg" alt="">
                        <section class="informacoes">
                            <p><span>Nome:</span> ${profissional.nome}</p>
                            <p><span>CRP:</span> ${profissional.crp ?? ''}</p>
                            <p><span>CRM:</span> ${profissional.crm ?? ''}</p>
                            <p><span>Atendimento:</span> ${profissional.atendimento}</p>
                            <p><span>Clínica:</span> ${profissional.clinica ?? ''}</p>
                            <p><span>Especialidade:</span> ${profissional.especialidade ?? ''}</p>
                            <p><span>Telefone:</span> ${profissional.telefone ?? ''}</p>
                        </section>
                    `;

                    document.getElementById('profissionais').appendChild(section);
                });

                offset += limit;

                if (data.hasMore) {
                    document.getElementById('verMais').style.display = 'block';
                } else {
                    document.getElementById('verMais').style.display = 'none';
                }
            } else {
                console.error('Dados de profissionais não encontrados:', data);
            }
        })
        .catch(error => console.error('Erro ao carregar profissionais:', error));
}
