package mannings.msi.com.ttdd.model;

public class Registro {

    private int id;
    private String grupo;
    private String kind;
    private String assunto;
    private String fase_corrente;
    private String fase_intermediaria;
    private String destinacao;
    private String observacoes;
    private int indice;
    private int proximo;

    public Registro() {
    }

    public Registro(int id, String grupo, String kind, String assunto, String fase_corrente, String fase_intermediaria, String destinacao, String observacoes, int indice, int proximo) {
        this.id = id;
        this.grupo = grupo;
        this.kind = kind;
        this.assunto = assunto;
        this.fase_corrente = fase_corrente;
        this.fase_intermediaria = fase_intermediaria;
        this.destinacao = destinacao;
        this.observacoes = observacoes;
        this.indice = indice;
        this.proximo = proximo;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getGrupo() {
        return grupo;
    }

    public void setGrupo(String grupo) {
        this.grupo = grupo;
    }

    public String getKind() {
        return kind;
    }

    public void setKind(String kind) {
        this.kind = kind;
    }

    public String getAssunto() {
        return assunto;
    }

    public void setAssunto(String assunto) {
        this.assunto = assunto;
    }

    public String getFase_corrente() {
        return fase_corrente;
    }

    public void setFase_corrente(String fase_corrente) {
        this.fase_corrente = fase_corrente;
    }

    public String getFase_intermediaria() {
        return fase_intermediaria;
    }

    public void setFase_intermediaria(String fase_intermediaria) {
        this.fase_intermediaria = fase_intermediaria;
    }

    public String getDestinacao() {
        return destinacao;
    }

    public void setDestinacao(String destinacao) {
        this.destinacao = destinacao;
    }

    public String getObservacoes() {
        return observacoes;
    }

    public void setObservacoes(String observacoes) {
        this.observacoes = observacoes;
    }

    public int getIndice() {
        return indice;
    }

    public void setIndice(int indice) {
        this.indice = indice;
    }

    public int getProximo() {
        return proximo;
    }

    public void setProximo(int proximo) {
        this.proximo = proximo;
    }
}
