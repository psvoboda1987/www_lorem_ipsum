window.onload = () => {
    let fakeText = document.getElementById('text')
    let transformedText = document.getElementById('transformed-text')

    const copyTriggers = []
    copyTriggers.push(fakeText)
    copyTriggers.push(transformedText)

    copyTriggers.forEach((trigger) => {
        if (trigger === null) return
        trigger.addEventListener('click', (e) => {
            e.preventDefault()
            copyText(e)
        })
    })
}

function copyText(e) {
    const copyText = e.target.innerText
    if (copyText === '') return
    const textArea = document.createElement('textarea')

    textArea.value = copyText
    textArea.style.top = '0'
    textArea.style.left = '0'
    textArea.style.position = 'fixed'

    document.body.appendChild(textArea)
    textArea.focus()
    textArea.select()

    if (document.execCommand('copy')) {
        document.body.removeChild(textArea)
        alert('copied')
        return;
    }

    alert('copy not successful')
}