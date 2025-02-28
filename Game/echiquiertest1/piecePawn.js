import { pieceParent } from "./pieceParent.js";

export class piecePawn extends pieceParent {
    sprite = "white-pawn.png";
    range=1;
    isPawn=true;


    setmovement() {
        //super();
        super.setmovement();
        this.movementPawn();
    }
}