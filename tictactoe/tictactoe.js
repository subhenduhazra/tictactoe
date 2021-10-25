class Tictactoe{
    constructor(){
        this.metaData={
            about:``,
            version:"1.1.0",
            releaseData:"01.05.2020"
        };
        this.history={}

        this.computerLevel="hard";

        this.arr=[];
        
        this.player1={id:"player1",name:"Player1",sign:'x',timeWon:0,playerType:"human"};
        this.player2={id:"player2",name:"Kitty",sign:'o',timeWon:0,playerType:"computer"};
        
        this.player2Name="Player2"

        //p2p (player to player) and p2c (player to computer)
        this.playType="p2c"; 

        this.currentTurn=this.player1;

        //this.restartGame();

        this.getSettingsFromLocal();
        this.getHistoryFromLocal()

    }

    restartGame(){
        this.arr=[
            [null,null,null],
            [null,null,null],
            [null,null,null]
            ];

        
        this.won=false;
        this.draw=false;
        this.readyToGetInput=true;

        this.currentTurn=(this.player1.sign=='x')?this.player1:this.player2;
        
       

        /////for vs computer only
        if(this.playType=="p2c" && this.currentTurn==this.player2){
            
            this.getInput(TTTAI.getComputerTurn(this.arr,this.player2.sign,this.computerLevel));
            
        }

        if(this.playType=="p2c"){
            this.player2.name="Kitty";
        }else{
            this.player2.name=this.player2Name;
        }


        this.showRestartGame();
        this.showChangedSign()
        this.showCurrentTurn();
        this.showScoreBoard();
        this.showChangePlayerName();
    }

    changePlayerName(player=this.player1,newName){
        //alert()
        if(player.id=="player1"){
            this.player1.name=newName;
        }else if(player.id=="player2"){
            if(player.playerType=="human"){
                this.player2.name=newName;
                this.player2Name=newName;
            }else{
                console.log("Hey, Our computer's name is kitty. If you want to change this contact with us ;) ")
            }
        }else{
            console.error("No player exists");
        }

        this.showChangePlayerName();
        this.saveSettingsToLocal();
    }

    showChangePlayerName(){
        let player1Name=this.player1.name;
        let player2Name=this.player2Name;
        console.log("player1: "+player1Name);
        console.log("player2: "+player2Name);
    }

    showRestartGame(){
        console.log("Game restarted ...");
    }

    changeType(type){
        // if(this.ifGameStarted()){
        //     this.showChangedType();
        //     return;
        // }

        if((this.playType=="p2p" && type=="p2c") || (this.playType=="p2c" && type=="p2p")){
            this.playType=type;
            this.restartGame();
            this.player1.timeWon=0;
            this.player2.timeWon=0;

            if(this.playType=="p2p"){
                this.player2.playerType="human";
            }
            if(this.playType=="p2c"){
                this.player2.playerType="computer";
                this.player2.name="Kitty";
            }
            
        }

        this.showChangedType();
        this.saveSettingsToLocal();

    }
    showChangedType(playType,player1,player2){
        console.log("playType:"+playType);
        console.log(player1);
        console.log(player2);
    }
    showDraw(){
        console.log("Draw");
    }

    showWin(){
        let player=this.currentTurn;
        if(this.won===true){
            console.log(player.name+" wins");
        }else{
            console.log("No winner till now.")
        }
    }

    setSignToCell(){
        console.log(this.arr);
    }

    showChangedSign(){
        let player1=this.player1;
        let player2=this.player2;
        console.log(player1.name+":"+player1.sign);
        console.log(player2.name+":"+player2.sign);

    }

    showScoreBoard(){
        let player1=this.player1;
        let player2=this.player2;
        console.log(player1.name+":"+player1.timeWon);
        console.log(player2.name+":"+player2.timeWon);
    }

    changeSign(){
        //if(!this.ifGameStarted() || (this.playType=="p2c" && this.player2.sign=='x')){
            let tmp_sign=this.player1.sign;
            this.player1.sign=this.player2.sign;
            this.player2.sign=tmp_sign;
            this.showChangedSign();
            
            this.restartGame();

        //}
        
        this.saveSettingsToLocal();


    }

    ifGameStarted(){
        for(let i=0;i<this.arr.length;i++){
            for(let j=0;j<this.arr[i].length;j++){
                if(this.arr[i][j]!=null){
                    return true;
                }
            }
        }
        return false;
    }

    ifGameEnded(){
        if(this.won || this.draw){
            return true;
        }else{
            return false;
        }
    }
    
    getInput(cell){
        if(this.readyToGetInput==false){
            return;
        }
        let valid=this.checkInputValidity(cell);
        if(valid){
            this.arr[cell[0]][cell[1]]=this.currentTurn.sign;
            ////view in browser
            this.setSignToCell(this.currentTurn.sign,cell);
            this.postInput();            
        }
    }

    postInput(){
        let won=this.checkForWin();
        if(won){
            ///won
            this.won=true;
            this.winPath=won;
            this.showWin();
            this.addToHistory();
            this.currentTurn.timeWon++;
            this.showScoreBoard(this.player1,this.player2);
        }else{
            let draw=this.checkForDraw();
            if(draw){
                //draw
                this.draw=true;
                this.showDraw();
                this.addToHistory();
                this.showScoreBoard(this.player1,this.player2);

            }else{
                this.swapTurn();

                //////computer will give it's turn
                if(this.playType=="p2c" && this.currentTurn==this.player2){
                    this.readyToGetInput=false;
                    setTimeout(() => {
                        this.readyToGetInput=true;
                        this.getInput(TTTAI.getComputerTurn(this.arr,this.player2.sign,this.computerLevel));
                        
                    }, 500);
                    
                }

            }
        }

    }

    showCurrentTurn(){
        let player=this.currentTurn;
        console.log("Currnt turn:"+player.name)
    }

    swapTurn(){
        if(this.won===false && this.draw===false){
            if(this.currentTurn==this.player1){
                this.currentTurn=this.player2;
            }else{
                this.currentTurn=this.player1;
            }
        }
        this.showCurrentTurn();
    }

    checkForWin(){
        //horizontal
        let arr=this.arr;
        if(arr[0][0]===arr[0][1] && arr[0][1]===arr[0][2] && arr[0][0]!=null){
            return {win:arr[0][0],path:{start:[0,0],end:[0,2]}};
        }
        if(arr[1][0]===arr[1][1] && arr[1][1]===arr[1][2] && arr[1][0]!=null){
            return {win:arr[1][0],path:{start:[1,0],end:[1,2]}};
        }
        if(arr[2][0]===arr[2][1] && arr[2][1]===arr[2][2] && arr[2][0]!=null){
            return {win:arr[2][0],path:{start:[2,0],end:[2,2]}};
        }

        //vertical
        if(arr[0][0]===arr[1][0] && arr[1][0]===arr[2][0] && arr[0][0]!=null){
            return {win:arr[0][0],path:{start:[0,0],end:[2,0]}};
        }
        if(arr[0][1]===arr[1][1] && arr[1][1]===arr[2][1] && arr[0][1]!=null){
            return {win:arr[0][1],path:{start:[0,1],end:[2,1]}};
        }
        if(arr[0][2]===arr[1][2] && arr[1][2]===arr[2][2] && arr[0][2]!=null){
            return {win:arr[0][2],path:{start:[0,2],end:[2,2]}};
        }

        //diagonal \
        if(arr[0][0]===arr[1][1] && arr[1][1]===arr[2][2] && arr[0][0]!=null){
            return {win:arr[0][0],path:{start:[0,0],end:[2,2]}};
        }

        //diagonal /
        if(arr[0][2]===arr[1][1] && arr[1][1]===arr[2][0] && arr[0][2]!=null){
            return {win:arr[0][2],path:{start:[0,2],end:[2,0]}};
        }

        return false;
        

    }

    checkForDraw(){
        for(let i=0;i<this.arr.length;i++){
            for(let j=0;j<this.arr[i].length;j++){
                if(this.arr[i][j]==null){
                    return false;
                }
            }
        }

        return true;
    }

    checkInputValidity(cell){
        if(this.won==true){
            return false;
        }else{
            if(this.arr[cell[0]][cell[1]]!=null){
                return false;
            }else{
                return true;
            }
        }
    }

    addToHistory(){
        /////implement tomorrow

    }

    getSettingsFromLocal(){
        if(localStorage.getItem("TTTLocalSettings") && localStorage.getItem("TTTLocalSettings").length>0){
            let settings=JSON.parse(localStorage.getItem("TTTLocalSettings"));
            

            ///config
            this.player1.name=settings.player1Name;
            this.player2Name=settings.player2Name;

        }
    }
    
    saveSettingsToLocal(){
        
        let settings={
            player1Name:this.player1.name,
            player2Name:this.player2Name,
        }
        
        localStorage.setItem("TTTLocalSettings",JSON.stringify(settings));
    }

    getHistoryFromLocal(){
        if(localStorage.getItem("TTTLocalHistory") && localStorage.getItem("TTTLocalHistory").length>0){
            this.history=JSON.parse(localStorage.getItem("TTTLocalHistory"));
        }
    }
    getHistoryFromLocal(){
        localStorage.setItem("TTTLocalHistory",JSON.stringify(this.history));
    }

    changeComputerLevel(level){
        if(level=="easy" || level=="medium" || level=="hard"){
            this.computerLevel=level;
        }else{
            console.error("Bad Keyword for : level")
        }
        this.showComputerLevel();
    }
    showComputerLevel(){
        console.log("Computer Level : "+this.computerLevel);
    }

}