class Calculator {
    constructor(previousNumber, currentNumber) {
        this.previousNumber = previousNumber
        this.currentNumber = currentNumber
        this.clear()
    }
    clear() {
        this.currentCalc = '0'
        this.previousCalc = ''
        this.currentOperand = undefined
    }
    detete() {
        if(this.currentCalc === '') this.currentCalc = '0'
        else {
            this.currentCalc = this.currentCalc.toString().slice(0, -1)
        }
    }
    appendNumber(number) {
        if(number === '.' && this.currentCalc.includes('.')) return
        this.currentCalc = this.currentCalc.toString() + number.toString()
    }
    appendSpecial(special) {
        if(special === '.' && this.currentCalc.includes('.')) return
        this.currentCalc = this.currentCalc.toString() + number.toString()
    }
    getOperand(operand) {
        if(this.currentOperand === '') return
        if(this.previousCalc != '') {
            this.calculate()
        }
        this.currentOperand = operand
        this.previousCalc = this.currentCalc
        this.currentCalc = ''
        this.display()
    }
    formatNumber(number) {
        const floatNumber = number.toString()
        const intergerDigits = parseFloat(floatNumber.split('.')[0])
        const decimalDigits = floatNumber.split('.')[1]
        let result

        if(isNaN(intergerDigits)) {
            result = '0'
        } else {
            result = intergerDigits.toLocaleString('en', {maximumFractionDigits: 0})
        }

        if(decimalDigits != null) {
            return `${result}.${decimalDigits}`
        } else {
            return result
        }
    }
    display() {
        this.currentNumber.innerText = this.formatNumber(this.currentCalc)
        if(this.currentOperand != null && this.previousCalc != '') {
            this.previousNumber.innerText = `${this.formatNumber(this.previousCalc)} ${this.currentOperand}`
        }
        else {
            this.previousNumber.innerText = `${this.formatNumber(this.previousCalc)}`
        }

        if(parseFloat(this.previousNumber.innerText) == 0 ) {
            this.previousNumber.innerText = ''
        }
    }
    calculate() {
        let result
        let previous = parseFloat(this.previousCalc)
        let current = parseFloat(this.currentCalc)
        if(isNaN(previous)) return
        if(isNaN(current))
            current = previous

        switch(this.currentOperand) {
            case '+':
                result = previous + current
                break
            case '-':
                result = previous - current
                break
            case 'x':
                result = previous * current
                break
            case '/':
                result = previous / current
                break
            default:
                return
        }

        this.currentCalc = result
        this.currentOperand = undefined
        this.previousCalc = ''
    }
}

var mouseIsDown = false
var idTimeout
const btnNumber = document.querySelectorAll('.number')
const currentNum = document.querySelector('.current-number')
const previousNum = document.querySelector('.previous-number')
const operand = document.querySelectorAll('.operand')
const equalBtn = document.querySelector('.equal')
const deleteBtn = document.querySelector('.delete')
const specialOperand = document.querySelector('.special-operand')
const calc = new Calculator(previousNum, currentNum)

btnNumber.forEach(button => {
    button.addEventListener("click", function() {
        calc.appendNumber(button.innerText)
        calc.display()        
    })
    
});
window.addEventListener("keydown", (e) => {
        if(
        e.key === '0' ||
        e.key === '1' ||
        e.key === '2' ||
        e.key === '3' ||
        e.key === '4' ||
        e.key === '5' ||
        e.key === '6' ||
        e.key === '7' ||
        e.key === '8' ||
        e.key === '9' ||
        e.key === '.' 
      ){
        calc.appendNumber(e.key)
        calc.display()
    } else if (
        e.key === '+' ||
        e.key === '-' ||
        e.key === '/' ||
        e.key === '%' 
       ) {
        calc.getOperand(e.key)
       } else if (e.key === '*') {
         calc.getOperand('x')
       } else if (e.key === 'Enter' || e.key === '=') {
        calc.calculate()
       } else if (e.key === 'Backspace') {
         calc.delete()
       } else if (e.key === 'Delete') {
         calc.clear()
       }
       calc.display()
    })
operand.forEach(op => {
    op.addEventListener("click", function() {
        calc.getOperand(op.innerText)
        calc.display()
    })
})
equalBtn.addEventListener("click",function() {
    calc.calculate()
    calc.display()
})
deleteBtn.addEventListener("mousedown", function() {
    mouseIsDown = true;
    idTimeout = setTimeout(() => {
        if (mouseIsDown){
            calc.clear()
            calc.display()
        }
    }, 1000);
})
deleteBtn.addEventListener("mouseup", function() {
    clearTimeout(idTimeout);
    mouseIsDown = false;
    calc.detete()
    calc.display()
})

