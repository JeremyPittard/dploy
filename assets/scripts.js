const dployTrigger = () => {
    const dployBtn = document.getElementById('dploy-button');
    const dployMsg = document.getElementById('dploy-msg');

    dployBtn.addEventListener('click', (e) => {

        e.preventDefault;
        dployBtn.classList.add('hide');
        dployMsg.classList.remove('destroyed')
        setTimeout(() => {
            dployMsg.classList.remove('hide')
            dployBtn.classList.add('destroyed');
        }, 350)

        fetch(dployBtn.getAttribute('data-address'))

    })

}
dployTrigger();