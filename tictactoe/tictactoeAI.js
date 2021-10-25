class TTTAI{
    static getComputerTurn(arr,sign,level='easy'){
        let winCell=TTTAI.checkWinCell(arr,sign);
        if(winCell!=null){
            return winCell
        }
        let preventCell=TTTAI.preventWinCell(arr,sign);
        if(preventCell!=null){
            return preventCell;
        }

        ////////////give another////
        if(level=='easy'){
            return TTTAI.getRandomValue(arr,sign);
        }

        if(level=="medium"){
            return TTTAI.getMediumValue(arr,sign);
        }

        if(level=='hard'){
            return TTTAI.getHardValue(arr,sign);
        }
    }

    static getMediumValue(arr,compSign){
        let min=0;
        let max=5;
        let r=Math.floor(Math.random()*(max-min) + min);

        if(r<=1){
            return TTTAI.getHardValue(arr,compSign);
        }else{
            return TTTAI.getRandomValue(arr,compSign);
        }
       
    }

    static getHardValue(arr,compSign){
        let bestScore=-Infinity;
        let bestMove;
        let rows=arr.length;
        let cols=arr.length;
        let bestMoveArr=[];

        for(let i=0;i<rows;i++){
            for(let j=0;j<cols;j++){
                if(arr[i][j]==null){
                    arr[i][j]=compSign;
                    //console.log(i+","+j);
                    let bs=TTTAI.minmax(arr,(compSign=='x')?'o':'x',compSign);
                    if(bs>bestScore){
                        bestScore=bs;
                        bestMove=[i,j];
                        bestMoveArr=[];
                        bestMoveArr.push(bestMove);
                    }else if(bs==bestScore){
                        bestScore=bs;
                        bestMove=[i,j];
                        bestMoveArr.push(bestMove);
                    }
                    arr[i][j]=null;
                    //console.log(bestMove);
                    //console.log(bestScore);
                }
            }
        }
        //console.log(bestMove)
        let min=0;
        let max=bestMoveArr.length;

        let r=Math.floor(Math.random()*(max-min) + min);

        return bestMoveArr[r];
    }

    static minmax(arr,currentTurn,compSign){
        //console.log(currentTurn+","+compSign);
        let rows=arr.length;
        let cols=arr.length;

        if(TTTAI.checkForWin(arr)){
            if(currentTurn==compSign){
                return -1;
            }else{
                return 1;
            }
        }else if(TTTAI.checkForDraw(arr)){
                return 0;
        }

        if(compSign==currentTurn){
            let bestScore=-Infinity;
            let bestMove;

            for(let i=0;i<rows;i++){
                for(let j=0;j<cols;j++){
                    if(arr[i][j]==null){
                        arr[i][j]=currentTurn;
                        let tmpScore=TTTAI.minmax(arr,(currentTurn=='x')?'o':'x',compSign);
                        arr[i][j]=null;
                        if(tmpScore>bestScore){
                            bestScore=tmpScore;
                            bestMove=[i,j];
                        }
                        //console.log(bestScore);
                    }
                }
            }
            //console.log(bestScore);
            return bestScore;
        }else{
            let bestScore=Infinity;
            let bestMove;

            for(let i=0;i<rows;i++){
                for(let j=0;j<cols;j++){
                    if(arr[i][j]==null){
                        arr[i][j]=currentTurn;
                        let tmpScore=TTTAI.minmax(arr,(currentTurn=='x')?'o':'x',compSign);
                        arr[i][j]=null;
                        if(tmpScore<bestScore){
                            bestScore=tmpScore;
                            bestMove=[i,j];
                        }
                    }
                }
            }
            //console.log(bestScore);
            return bestScore;
        }
    }
    static getRandomValue(arr,sign){
        let row;
        let col;
        let u=0;
        let r;
        do{
            let min=0;
            let max=9;
            r=Math.floor(Math.random()*(max-min) + min);

            row=Math.floor(r/3);
            col=Math.floor(r%3);

            //console.log(row+","+col)
            u++;
        }while(arr[row][col]!=null && u<6000);
        if(u>=6000){
            //console.log(row+","+col+","+r);
            throw "Problem in computer turn. Stopping ...";
            //return [0,0];
        }
        return [row,col];
    }

    static checkWinCell(arr,sign){
        return TTTAI.winCell(arr,sign);
    }

    static preventWinCell(arr,sign){
        sign=(sign=='x')?'o':'x';
        return TTTAI.winCell(arr,sign);
    }

    static checkForWin(arr){
        //horizontal
        
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

    static checkForDraw(arr){
        for(let i=0;i<arr.length;i++){
            for(let j=0;j<arr[i].length;j++){
                if(arr[i][j]==null){
                    return false;
                }
            }
        }

        return true;
    }


    static winCell(arr,sign){
        //cell [0,0]
        if(arr[0][0]==null && ((arr[0][1]==arr[0][2] && arr[0][2]==sign) || (arr[1][0]==arr[2][0] && arr[2][0]==sign) || (arr[1][1]==arr[2][2] && arr[2][2]==sign))){
            return [0,0];
        }

        //cell [0,1]
        if(arr[0][1]==null && ((arr[0][0]==arr[0][2] && arr[0][2]==sign) || (arr[1][1]==arr[2][1] && arr[2][1]==sign))){
            return [0,1];
        }

        //cell [0,2]
        if(arr[0][2]==null && ((arr[0][0]==arr[0][1] && arr[0][1]==sign) || (arr[1][2]==arr[2][2] && arr[2][2]==sign) || (arr[1][1]==arr[2][0] && arr[2][0]==sign))){
            return [0,2];
        }

        //cell [1,0]
        if(arr[1][0]==null && ((arr[0][0]==arr[2][0] && arr[2][0]==sign) || (arr[1][1]==arr[1][2] && arr[1][2]==sign))){
            return [1,0];
        }

        //cell [1,1]
        if(arr[1][1]==null && ((arr[1][0]==arr[1][2] && arr[1][2]==sign) || (arr[0][1]==arr[2][1] && arr[2][1]==sign) || (arr[0][0]==arr[2][2] && arr[2][2]==sign) || (arr[0][2]==arr[2][0] && arr[2][0]==sign))){
            return [1,1];
        }

        //cell [1,2]
        if(arr[1][2]==null && ((arr[1][0]==arr[1][1] && arr[1][1]==sign) || (arr[0][2]==arr[2][2] && arr[2][2]==sign))){
            return [1,2];
        }

        //cell[2,0]
        if(arr[2][0]==null && ((arr[2][1]==arr[2][2] && arr[2][2]==sign) || (arr[0][0]==arr[1][0] && arr[1][0]==sign) || (arr[1][1]==arr[0][2] && arr[0][2]==sign))){
            return [2,0];
        }

        //cell [2,1]
        if(arr[2][1]==null && ((arr[2][0]==arr[2][2] && arr[2][2]==sign) || (arr[0][1]==arr[1][1] && arr[1][1]==sign))){
            return [2,1];
        }

        //cell [2,2]
        if(arr[2][2]==null && ((arr[2][0]==arr[2][1] && arr[2][1]==sign) || (arr[0][2]==arr[1][2] && arr[1][2]==sign) || (arr[0][0]==arr[1][1] && arr[1][1]==sign))){
            return [2,2];
        }

    }
}