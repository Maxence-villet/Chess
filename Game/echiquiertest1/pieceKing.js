import { pieceParent } from "./pieceParent.js";

export class pieceKing extends pieceParent {
    sprite = "white-king.png";
    range=1;


    setmovement() {
        //super();
        super.setmovement();
        this.movementRook();
        this.movementBishop();
    }
}