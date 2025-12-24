// Selecionar elementos do DOM
let menuItem = document.querySelectorAll('.item-menu') // Todos os itens do menu
let mainContainer = document.querySelector('.main-container') // Container principal CORRIGIDO

// Função para selecionar link do menu
function selectLink(){
    // Remove a classe 'ativo' de todos os itens
    menuItem.forEach((item) => {
        item.classList.remove('ativo')
    })
    // Adiciona a classe 'ativo' apenas no item clicado
    this.classList.add('ativo')
}

// Adicionar evento de click em cada item do menu
menuItem.forEach((item) => {
    item.addEventListener('click', selectLink)
})

// Botão expandir/recolher menu
let btnExp = document.querySelector('#btn-exp')
let menuSide = document.querySelector('.slider')

btnExp.addEventListener('click', function(){
    // Alternar classe expandir no menu
    menuSide.classList.toggle('expandir')
    
    // CORREÇÃO: A responsividade agora é feita via CSS
    // Não é mais necessário ajustar margens via JavaScript
    console.log('Menu ' + (menuSide.classList.contains('expandir') ? 'expandido' : 'recolhido'))
})

// CORREÇÃO: Remover ou atualizar os event listeners específicos
// que estavam alterando cores e layouts de forma fixa
let lista = document.querySelectorAll('ul > li')

// Exemplo de como adicionar funcionalidades específicas para cada item
lista[1].addEventListener('click', () => {
    // Aqui você pode adicionar lógica específica para o item 1
    console.log('Relatórios clicado')
    // Removido alterações de estilo fixas que quebravam a responsividade
})

lista[2].addEventListener('click', () => {
    // Aqui você pode adicionar lógica específica para o item 2
    console.log('Balance clicado')
    // Removido alterações de estilo fixas que quebravam a responsividade
})

// CORREÇÃO ADICIONAL: Garantir responsividade em redimensionamento
window.addEventListener('resize', function() {
    // Se necessário, adicionar lógica para ajustes em diferentes tamanhos de tela
    console.log('Janela redimensionada: ' + window.innerWidth + 'px')
})
