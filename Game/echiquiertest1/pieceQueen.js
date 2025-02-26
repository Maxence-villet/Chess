import { pieceParent } from "./pieceParent.js";

export class pieceQueen extends pieceParent {
    sprite = "white-queen.png";


    setmovement() {
        //super();
        super.setmovement();
        this.movementRook();
        this.movementBishop();
    }
}