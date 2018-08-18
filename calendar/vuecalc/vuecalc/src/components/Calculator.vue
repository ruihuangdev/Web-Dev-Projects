<template>
  <div class="calculator">
    <div class="display">{{current || '0'}}</div>
      <div class="button" @click="clear" >C</div>
      <div class="button" @click="sign" >+/-</div>
      <div class="button" @click="percent" >%</div>
      <div class="button operator"  @click="divide" >&divide;</div>
      <div class="button" @click="appendNumber('7')" >7</div>
      <div class="button" @click="appendNumber('8')" >8</div>
      <div class="button" @click="appendNumber('9')" >9</div>
      <div class="button operator" @click="multiply" >x</div>
      <div class="button" @click="appendNumber('4')" >4</div>
      <div class="button" @click="appendNumber('5')" >5</div>
      <div class="button" @click="appendNumber('6')" >6</div>
      <div class="button operator" @click="minus" >-</div>
      <div class="button" @click="appendNumber('1')" >1</div>
      <div class="button" @click="appendNumber('2')" >2</div>
      <div class="button" @click="appendNumber('3')" >3</div>
      <div class="button operator" @click="add" >+</div>
      <div class="button zero" @click="appendNumber('0')" >0</div>
      <div class="button" @click="appendDot" >.</div>
      <div class="button operator" @click="displayOutcome" >=</div>

  </div>
</template>
<script>
  export default{
    data(){
      return{
        current: "0",
        previous: null,
        operator: null,
        operatorClicked: false,
      }
    },
    methods:{
      clear(){
        this.current="";
      },
      sign(){
        this.current = this.current.charAt(0) === '-'? this.current.slice(1):`-${this.current}`;
        //TODO modify this method
      },
      percent(){
        this.current=`${parseFloat(this.current)/100}`
      },
      appendNumber(number){
        if (this.operatorClicked){
          //check if an operator is clicked. Reset number state
          this.clear();
          this.operatorClicked = false;
        }
        //check if the current is zero
        if (this.current === '0'){
          this.current = `${number}`;
        }
        this.current = `${this.current}${number}`;
      },
      appendDot(){
        if (this.current.indexOf('.') === -1) {
          this.appendNumber('.');
        }
      },
      operate(){
        this.previous = this.current;
        this.operatorClicked = true;
      },
      divide(){
        this.operator = (a, b) => a/b;
        this.operate();
      },
      multiply(){
        this.operator = (a, b) => a*b;
        this.operate();
      },
      add(){        
        this.operator = (a, b) => a+b;
        this.operate();
      },
      minus(){        
        this.operator = (a, b) => a-b;
        this.operate();
      },
      displayOutcome(){
        this.current = `${this.operator(parseFloat(this.current), parseFloat(this.previous))}`;
        this.pareseFloat = null;
      }
    }
  }
</script>
<style lang="scss" scoped>
.calculator {
  width: 375px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-auto-rows: minmax(50px, auto);
}
.display {
  grid-column: 1/5;
  background-color: #424242;
  color: #fafafa;
  text-align: right;
  padding: 20px;
  font-size: 1.5rem;
}

.button {
  font-size: 1.5rem;
  background-color: #424242;
  text-align: center;
  border: 1px solid #fafafa;
  color: #fafafa;
  display: flex;
  justify-content: center;
  align-items: center;
}
.zero {
  grid-column: 1/3;
}
.operator {
  background-color: #ff9800;
  color: #424242;
}
</style>
