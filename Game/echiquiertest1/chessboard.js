
export var limit2=8
export var limit=limit2-1
var player1=true;
var activatedSlots=[];
var activatedpiece=null;
import { pieceParent } from './pieceParent.js';
import { pieceRook } from './pieceRook.js';
import { pieceBishop } from './pieceBishop.js';
import { pieceQueen } from './pieceQueen.js';
import { pieceKing } from './pieceKing.js';
import { pieceKnight } from './pieceKnight.js';
import { piecePawn } from './piecePawn.js';



function spawnechiquier() {
    setPieceIndex()

    const gridContainer = document.querySelector('.grid-container');

    for (let i = 0; i < limit2; i++) {
        const row = document.createElement('div');
        row.classList.add('grid-row');
        
    
        for (let j = 0; j < limit2; j++) {
            const button = document.createElement('button');
            //button.style.backgroundColor='rgb(33, 42, 112)';
            
            if (setactivatedslots(j,i)) {
            button.style.backgroundColor='rgb(0, 30, 255)';
            } else {
            button.style.backgroundColor='rgb(33, 42, 112)';
            }
    
            const img = document.createElement('img');
            var spawning = isspawning(j,i);
            
            if (spawning[0]) {
                
                console.log("sasha"+spawning[1].getisboard1())
                img.src = spawning[1].sprite; // Remplacez par le chemin de votre image
                img.alt = 'Image';
                img.style.width = '100%'; // Ajustez la taille de l'image
                img.style.height = '100%';
                if (spawning[1].getisboard1()) {
                    img.style.backgroundColor='rgb(30, 255, 0)';
                } else {
                    img.style.backgroundColor='rgb(255, 0, 0)';
                }
                
                
                button.appendChild(img);
            }
            
    
            button.addEventListener('click', () => slotclick(j, i));

            row.appendChild(button);
        }
    
        gridContainer.appendChild(row);
    }

}

function slotclick(row,col) {
    //alert(`coucou miaou`+);
    var spawning = isspawning(row,col);
    var isslotactivated = setactivatedslots(row,col)
    if (isslotactivated) {
        if (spawning[0]==false) {
        teleportpiece(row,col);
        } else {
        if (spawning[1].getisboard1()==false) {
            destroyPiece(spawning[1]);
            teleportpiece(row,col);
        }
        
        }
        
        
    }
    if (spawning[0]) {
                
        //alert(`coucou miaou`);
                
                //destroyPiece(spawning[1]);
                if (spawning[1].getisboard1()) {
                activatedpiece=spawning[1];
                spawnmovement(row,col);
            }
                
    }

}

function teleportpiece(row,col) {
    activatedpiece.setposition(row,col);
    activatedSlots=[];
    activatedpiece=null;
    resetGrid();
}

function changeplayer() {
    player1= !player1
    resetGrid();
}


function clearGrid() {
    const gridContainer = document.querySelector('.grid-container');
    gridContainer.innerHTML = ""; // Vide le contenu du conteneur
}

function resetGrid() {
    clearGrid();
    spawnechiquier();
}





function createboard(isplayer1) {
var piece1 = null
var objectList = [];

piece1 = new pieceRook()
objectList.push(piece1)

piece1 = new pieceBishop()
objectList.push(piece1)

piece1 = new pieceKnight()
objectList.push(piece1)

piece1 = new pieceQueen()
objectList.push(piece1)

piece1 = new pieceKing()
objectList.push(piece1)

piece1 = new pieceKnight()
objectList.push(piece1)

piece1 = new pieceBishop()
objectList.push(piece1)

piece1 = new pieceRook()
objectList.push(piece1)




for (let i = 0; i < 8; i++) {
    piece1 = new piecePawn()
    objectList.push(piece1)
}





var index=0;
var indexX=0
var indexY=0;
var indexY1=0;
var xposition=0;
var yposition=0;



objectList.forEach(object => {
    if (isplayer1==true) {
        yposition=limit-indexY;
        xposition=limit-indexX;

        
    } else {
        yposition=0+indexY;
        xposition=indexX;
    }

    object.setposition(xposition,yposition);
    object.setisboard1(isplayer1==true);
    object.showInformation();
    
    index+=1;
    indexX+=1;
    indexY1+=1;
    if (indexY1==limit2) {
        indexY1=0;
        indexX=0;
        indexY+=1;
    }
});



objectList.forEach(object => {
    object.showInformation();
    
});



console.log("longueur : "+objectList.length);
return objectList;
}

var board1 = null;

var board2 = null;
var piece_player=false;

function isspawning(x,y) {
    var spawnbool=false

    spawnbool=isspawning2(true,x,y)
    if (spawnbool[0]==false) {
    piece_player=true;
    spawnbool=isspawning2(false,x,y)
}
    
    return [spawnbool[0],spawnbool[1]]; //,piece_player,spawnbool[1]
}

function setPieceIndex() {
    setPieceIndex2(board1);  
    setPieceIndex2(board2);   
}

function setPieceIndex2(objectlist) {
    var index = 0
    //alert(`petite tomate (${objectlist.length})`);
    
    objectlist.forEach(object => {
    object.setboardindex(index)
    //console.log("bouffon"+object.getboardindex());
    //
    index += 1
    })
}


function isspawning2(isboard1,x,y) {
    var objectlist=board2
    if (isboard1==true) {
        objectlist=board1
        
    }
    var spawnbool2=false  
    var object2=null;
    objectlist.forEach(object => {
        var toto = object.getx()==x && object.gety()==y
        //console.log("case x : "+ x + " case y : "+ y + " object x : "+object.getx() +  " object y : "+object.gety() +"result : "+ toto );
        if (toto) {
            spawnbool2=true;
            object2=object;
        }
    })
    return [spawnbool2,object2]
}





function destroyPiece(currentpiece) {
    
if (currentpiece.isboard1) {
    destroyPiece2(board1,currentpiece.getboardindex());
} else 
{
destroyPiece2(board2,currentpiece.getboardindex());
}
resetGrid()
}

function destroyPiece2(currentlist,index) {
currentlist.splice(index,1);
}



function setactivatedslots(x,y) {
var isactivated=false;

for (let i = 0; i < activatedSlots.length; i++) {
    if (activatedSlots[i][0]==x && activatedSlots[i][1]==y) {
        isactivated=true
    }
}

return isactivated;
}

function spawnmovement(x,y) {
    activatedSlots=[];
    activatedpiece.setmovement();
    console.log("russie : "+activatedpiece.getactivatedslots().length);
    for (let i = 0; i < activatedpiece.getactivatedslots().length; i++) {
    spawnmovement2(x,y,activatedpiece.getactivatedslots()[i][0],activatedpiece.getactivatedslots()[i][1])
    }
    
    resetGrid();
}


function spawnmovement2(x,y,xPlus,yPlus) {
    var collided=false;
    for (let i = 0; i < activatedpiece.getrange(); i++) {

        if (collided==false) {
        var newX = x+((1+i)*xPlus);
        var newY = y+((1+i)*yPlus);
        var spawningvar = isspawning(newX,newY);
        if (spawningvar[0]==false) {
            activatedSlots.push([newX, newY]);
        }  else {
            if (activatedpiece.getisPawn()==false) {
            collided=true;
            
            if (spawningvar[1].getisboard1()==false) {
            
            activatedSlots.push([newX, newY]);
        
            
            } } else {
                var spawningvar2 = isspawning(newX+1,newY);
                if (spawningvar2[0]==true) {
                    activatedSlots.push([newX+1, newY]);
                }
    
                spawningvar2 = isspawning(newX-1,newY);
                if (spawningvar2[0]==true) {
                    activatedSlots.push([newX-1, newY]);
                }
                
                
            }
        }
        /*
        if (spawningvar[0]==false) {
        spawnmovement3(x,y,xPlus,yPlus,i);
    } else {
        collided=true;
        if (spawningvar[1].getisboard1()) {
        //spawnmovement3(x,y,xPlus,yPlus);
        } else {
        spawnmovement3(x,y,xPlus,yPlus,i);
        }
    }*/
        }
    }
}

function spawnmovement3(x,y,xPlus,yPlus,i) {
    activatedSlots.push([x+((1+i)*xPlus), y+((1+i)*yPlus)]);
}

function beginplay() {
console.log("selectedslotnumber"+activatedSlots.length);
board1=createboard(true)
board2=createboard(false)
spawnechiquier()
}

beginplay();