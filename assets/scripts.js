const dployTrigger = () => {
    console.log('dploy trigger initialised')
    const dployBtn = document.getElementById('dploy-button');

    dployBtn.addEventListener('click', (e) => {

        e.preventDefault;

        console.log(dployBtn.getAttribute('data-address'))

        fetch(dployBtn.getAttribute('data-address'))

    })

}
dployTrigger();