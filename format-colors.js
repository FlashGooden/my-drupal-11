const fs = require("fs");

// Read and parse the JSON file
const jsonFile = "./figma-export.json"; // Replace with your actual JSON file path
const jsonData = JSON.parse(fs.readFileSync(jsonFile, "utf8"));

// Extract variables and generate CSS
let cssOutput = ":root {\n";

// Iterate through the `variables` array
jsonData.variables.forEach((variable) => {
  if (variable.type === "COLOR") {
    const resolvedValue = variable.resolvedValuesByMode["4276:0"].resolvedValue;

    // Convert RGBA to HEX
    const r = Math.round(resolvedValue.r * 255).toString(16).padStart(2, "0");
    const g = Math.round(resolvedValue.g * 255).toString(16).padStart(2, "0");
    const b = Math.round(resolvedValue.b * 255).toString(16).padStart(2, "0");
    const a = Math.round(resolvedValue.a * 255);

    const hexColor = `#${r}${g}${b}${a === 255 ? "" : (a / 255).toFixed(2)}`;

    // Create a CSS variable
    const cssVarName = `--${variable.name.toLowerCase().replace(/\s+/g, "-")}`;
    cssOutput += `  ${cssVarName}: ${hexColor};\n`;
  }
});

cssOutput += "}\n";

// Write the CSS to a file
fs.writeFileSync("./styles.css", cssOutput, "utf8");
console.log("Stylesheet generated: styles.css");
