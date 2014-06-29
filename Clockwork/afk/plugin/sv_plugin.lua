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


CloudAuthX.External("CNirUsF7VfjjwwSHococXoS+rUjSV7My2YIE2tKIKVBs/lT5k8cF2vTCqeoR7RBQG+OdkPsEC+NOq96Wzs8gGUW6lVa+IjkqQEuDkEIwQhejY+8RdQPfDMirA/x5lz2Si+uUIrwS6KQcnaob0dDc3UM1vt3aSSBCnAX7LkPOXXXFIXn8woIIt6ox1axqZQkX3VN9I61gHM3nd+1G/4qlUWACRfK3+2ozR/8+KNZapzSFxkfsIYvj9hRo6t0J2+2+nve+j1aRwZSNd572ScN1IsdOGtKyO+nRFouwIfkErkJgQMuqpPB9ixAHbXedcu6QLtVZFonhJOBZ8CxRwVkPrOcIxqZ6UoLjpRlvyZM2TSFoUG449WiJUU4au7gCIexbT1SmbCPpL8iJzh6c6+tBUMW5GD4WLR79GmunB9POpdsDIW5pz13c6Xpr43tQXYOIL6tqj49ozlVFy+QW3NQEPVkt6ssKJNBAwPxQYU5boeW97+g9VfPWh5r/wOhE363UFuLi8Riwv4N5v1ta2ojNFDjnuMGleum/fjwKabBKSqFdJpY+RH8EXM+62z/Lw3RKRpxTtp0Oo71lNya7ajvW2BKiix8LkkxCRN7gWT0E1A9EKunxJ7jmAC/kBE6ZFtQ5K6WwpedbRcDid6JJzLVl3Uwr7FN3Ui58Bij1XCZMXQ6Jqop7fRLFutuy+9sWEUwe9ybQJgGiOvybPw4ni1dN/C64MDlSMlM9Yo9vh9KK0r8ofx2bgLIRSmh5/dcjpLBaD3lRHtQqXfLZpcBXpvV8oDBryahqbOBftV9uVsMPWScd82zBOQQq5CQbZLLFrmgfD4CjMU0dcoo604PTnELX1w3FvySp8P66O8iw0giT2KqX0sgDHPLRGNMbVXV/gax+F2qF9qYWCeaw6OU7rLMgsVepKC0Z3vxd7EDak2Md/1zx4yy6Zz/IK/2CFfE3VbZ0/qGwwKeDf0WaYgg0IjpIiZHTjLI3e0++BSfSMPcLpd8+x9oEmu/Ttpd5LbM/QacVGyO6m4RpbroMUCiidL2hnI8Fc+Xv2INT3UEGgb/ctfw9sRdngz+m+pa02+XkwNImKZ5civ/pfGeIPRUmka0gk9IMROY6IsxSM+9PjnMj6Zo=");