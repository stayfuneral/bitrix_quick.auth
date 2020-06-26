window.onload = function() {

    let userId;
    
    const input = document.getElementById('select_user');
    const button = document.getElementById('authorize');

    input.addEventListener('change', () => {
        userId = input.value;
    })

    button.addEventListener('click', () => {
        if(!userId) {
            alert('Пользователь не выбран');
        } else {
            const request = sendAjax('ramapriya:quick.auth', 'sendUserId', 'class', {
                user: userId
            });

            request.then(response => {
                if(response.result === 'error') {
                    alert(response.error_description)
                } else {
                    window.location.reload(true)
                }
            })
        }
    })

    async function sendAjax(component, action, mode, params = {}) {

        const request = await BX.ajax.runComponentAction(component, action, {
            mode: mode,
            data: params
        });

        return await request.data
    }
    
}