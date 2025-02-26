import { limit2 } from './chessboard.js';
export class pieceParent {
    boardindex=-1;
    x = 0;
    y = 0;
    isboard1=true;
    sprite = "white-knight.png";
    activatedSlots=[];
    range = limit2;
    isPawn=false;
    



    constructor() {
    }





    setsprite(newsprite) {
        this.sprite = newsprite;
    }

    getsprite() {
        return this.sprite;
    }

    


    
    setx(newX) {
        this.x=newX;
    }

    getx() {
        return this.x;
    }


    sety(newY) {
        this.y=newY;
    }

    gety() {
        return this.y;
    }

    

    setisboard1(newisboard1) {
        this.isboard1=newisboard1;
    }

    getisboard1() {
        return this.isboard1;
    }

    setboardindex(newboardindex) {
        this.boardindex=newboardindex;
    }

    getboardindex() {
        return this.boardindex;
    }

    setactivatedslots(newactivatedslot) {
        
        this.activatedSlots = newactivatedslot;
    }


    getactivatedslots() {
        return this.activatedSlots
    }


    setrange(newRange) {
        this.range=newRange;
    }

    getrange() {
        return this.range;
    }

    getisPawn() {
        return this.isPawn;
    }

    setisPawn(newisPawn) {
        this.isPawn=newisPawn;
    }
    
    
    

    



























    
    addactivatedslots(toadd) {
        var newactivatedslot = this.getactivatedslots();
        newactivatedslot.push(toadd);
        this.setactivatedslots(newactivatedslot)
    }

    setposition(newX,newY) {
        

        this.sety(newY);
        this.setx(newX);

    }




    showInformation() {
        console.log("sprite"+this.sprite + " x :"+this.x + " y :"+this.y + "range : "+this.range);
        //this.setmovement();
    }













    setmovement() {
        
        this.setactivatedslots([])
        //this.movementRook();
        
        /*
        console.log("maya : "+this.getactivatedslots());
        for (let i = 0; i < activatedSlots.length; i++) {
            console.log("maya : ");
            //+activatedSlots[0]+"mayaya : "+activatedSlots[1]
            }*/
        
    }

    movementRook(){
        this.addactivatedslots([0,  1]);
        this.addactivatedslots([0, -1]);
        this.addactivatedslots([1,  0]);
        this.addactivatedslots([-1, 0]);
        
    }

    movementBishop(){
        this.addactivatedslots([1,  1]);
        this.addactivatedslots([1, -1]);
        this.addactivatedslots([-1,  1]);
        this.addactivatedslots([-1, -1]);
        
    }

    movementKnight(){
        this.addactivatedslots([2,  1]);
        this.addactivatedslots([2, -1]);
        this.addactivatedslots([-2,  1]);
        this.addactivatedslots([-2, -1]);

        this.addactivatedslots([1,  2]);
        this.addactivatedslots([1, -2]);
        this.addactivatedslots([-1,  2]);
        this.addactivatedslots([-1, -2]);
        
    }

    movementPawn() {
        this.addactivatedslots([0,  -1]);
    }
    
}



