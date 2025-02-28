import { pieceParent } from "./pieceParent.js";

export class pieceRook extends pieceParent {
    sprite = "white-rook.png";


    setmovement() {
        //super();
        super.setmovement();
        this.movementRook();
    }
}