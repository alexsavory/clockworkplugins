--[[
	Tru
--]]
local Clockwork = Clockwork;
local SCHEMA = SCHEMA;

concommand.Add("afk", function(ply)
if ply:GetNWBool("afk",false) then
ply:GodDisable()
ply:SendLua("Clockwork.BlackFadeIn = 0")
ply:Freeze(false)
ply:SetNWBool("afk",false)
Clockwork.player:Notify(ply, "You are no longer in AFK mode.")
Clockwork.player:NotifyAll(ply:Name().." is no longer AFK.");
ply:SetCharacterData( "customclass", nil );
else
local found = false
for k,v in pairs(ents.FindInSphere(ply:GetPos(),600)) do 
if (v:IsPlayer() or (v:IsNPC() and v:GetClass() != "npc_cscanner" and v:GetClass() != "npc_combine_camera") or v.IsZombie) and v != ply then
if v:IsPlayer() then 
Clockwork.player:Notify(ply, "There is another character. Please be alone before attempt to go AFK.")
else
Clockwork.player:Notify(ply, "There is a NPC near you. Be alone before attempting to go AFK.")
end
found = true

break
end
end

if found then return end

ply:GodEnable()
ply:SendLua("Clockwork.BlackFadeIn = 255")
ply:SetNWBool("afk",true)
Clockwork.player:NotifyAll(ply:Name().." is now in AFK Mode.");
ply:SetCharacterData( "customclass", "[AFk] Away From Keyboard" );
Clockwork.player:Notify(ply, "You are now in AFK mode. To disable, simply type /afk again.")
ply:Freeze(true)
end
end)