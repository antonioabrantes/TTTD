package mannings.msi.com.ttdd.model;

public class RegistroOnos1 {

    private String assunto;
    private String subAssunto;

    public RegistroOnos1() {
    }

    public RegistroOnos1(String assunto, String subAssunto) {
        this.assunto = assunto;
        this.subAssunto = subAssunto;
    }

    public String getAssunto() {
        return assunto;
    }

    public void setAssunto(String assunto) {
        this.assunto = assunto;
    }

    public String getSubAssunto() {
        return subAssunto;
    }

    public void setSubAssunto(String subAssunto) {
        this.subAssunto = subAssunto;
    }
}

