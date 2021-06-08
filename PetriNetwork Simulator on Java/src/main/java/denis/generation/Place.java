package denis.generation;

public class Place extends Apex{
    protected int tokens = 0;

    public Place(String name, int tokens){
        super(name);
        this.tokens = tokens;
    }

    public Place(String name, int tokens, long id){
        super(name, id);
        this.tokens = tokens;
    }

    public void changeTokens(int count){
        if(this.tokens + count >= 0){
            this.tokens += count;
        }
    }

    public void removeTokensForReset(){
        tokens = 0;
    }

    public void setTokens(int tokens)
    {
        this.tokens = tokens;
    }

    public int getTokens()
    {
        return tokens;
    }
}
